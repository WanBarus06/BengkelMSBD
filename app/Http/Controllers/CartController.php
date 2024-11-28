<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        // Ambil cart yang statusnya masih 'awaiting'
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect ke halaman login jika user belum login
        }
    
        // Ambil cart yang sedang menunggu berdasarkan user_id dan status 'awaiting'
        $cart = Cart::where('user_id', Auth::id())
        ->where('status', 'Belum Memesan')
        ->first();
    
        // Jika cart tidak ditemukan, tampilkan halaman kosong atau buat cart baru
        if (!$cart) {
            // Anda bisa menambahkan logika untuk membuat cart baru atau tampilkan halaman kosong
            $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'Menunggu Konfirmasi')
            ->first();
        }
    
        // Ambil semua item dalam cart
        $cartItems = CartItem::with('product')->where('cart_id', $cart->id)->get();

        //Pakai Stored Function
        $cartTotal = DB::select("SELECT cartTotal(?) AS total", [$cart->id]);

        // Kirimkan data cart dan cartItems ke view
        return view('cart', [
            'cart' => $cart,
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal[0]->total, // Ambil nilai total dari hasil query
        ]);
    }
    public function store(Request $request,  $product_id)
    {
        // 1. Ambil produk berdasarkan ID

        $product = Product::with('productDetail')->findOrFail($product_id);

        // 2. Periksa apakah user sudah memiliki cart yang aktif
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'Belum Memesan')
                    ->first();

        if (!$cart) {
            // Jika cart belum ada, buat cart baru
            $cart = Cart::create([
                'user_id' => Auth::id(),
            ]);
        }

        // 3. Periksa apakah produk sudah ada di cart
        $cartDetail = CartItem::where('cart_id', $cart->id)
                               ->where('product_id', $product->product_id)
                               ->first();

        if ($cartDetail) {
               // Jika produk sudah ada, update quantity dan harga
            $cartDetail->quantity += $request->input('quantity', 1); // Tambah kuantitas
            $cartDetail->price = $product->productDetail->product_sell_price; // Update harga terbaru
            $cartDetail->save();
        } else {
            // Jika produk belum ada, buat item baru di cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->product_id,
                'price' => $product->productDetail->product_sell_price,
                'quantity' => 1,
            ]);
        }

         // 4. Pastikan semua item di keranjang memiliki harga terbaru
        CartItem::where('cart_id', $cart->id)
        ->where('product_id', $product->id)
        ->update([
        'price' => $product->productDetail->product_sell_price,
        ]);

        // 4. Redirect atau kembali ke halaman cart untuk melihat isi keranjang
        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function destroy($product_id)
    {
        // 1. Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect ke halaman login jika user belum login
        }
    
        // 2. Ambil cart yang aktif berdasarkan user_id
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'Belum Memesan')
                    ->first();
    
        // 3. Periksa apakah cart ditemukan
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Cart tidak ditemukan.');
        }
    
        // 4. Ambil CartItem berdasarkan cart_id dan product_id
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product_id)
                            ->first();
    
        // 5. Jika CartItem ditemukan, hapus produk tersebut
        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan di keranjang.');
        }
    }

    public function deleteAllItems()
    {
        // 1. Periksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect ke halaman login jika user belum login
        }
    
        // 2. Ambil cart yang aktif berdasarkan user_id
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'Belum Memesan')
                    ->first();
    
        // 3. Periksa apakah cart ditemukan
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Cart tidak ditemukan.');
        }
    
        // 4. Hapus semua item dalam cart
        CartItem::where('cart_id', $cart->id)->delete();
    
        // 5. Redirect ke halaman cart dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Semua produk berhasil dihapus dari keranjang.');
    }

    public function increaseQuantity($cartItemId)
    {
        // 1. Ambil cartItem berdasarkan id yang diberikan
        $cartItem = CartItem::findOrFail($cartItemId);
    
        // 2. Ambil produk terkait dari CartItem
        $product = $cartItem->product;
    
        // 3. Periksa apakah kuantitas melebihi stok
        if ($cartItem->quantity >= $product->productDetail->stock) {
            return redirect()->route('cart.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }
    
        // 4. Tambah kuantitas
        $cartItem->quantity += 1;
        $cartItem->save();
    
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil ditambah.');
    }
    
    public function decreaseQuantity($cartItemId)
    {
        // 1. Ambil cartItem berdasarkan id yang diberikan
        $cartItem = CartItem::findOrFail($cartItemId);
    
        // 2. Periksa apakah kuantitas lebih dari 1, karena minimal beli 1
        if ($cartItem->quantity <= 1) {
            return redirect()->route('cart.index')->with('error', 'Kuantitas produk tidak dapat kurang dari 1.');
        }
    
        // 3. Kurangi kuantitas
        $cartItem->quantity -= 1;
        $cartItem->save();
    
        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil dikurangi.');
    }

    public function booking($cart_id)
    {
        // Ambil cart berdasarkan ID
        $cart = Cart::findOrFail($cart_id);
    
        // Periksa apakah cart kosong (tidak ada item)
        $cartItemsCount = $cart->cartItems()->count(); // Menghitung jumlah item di cart
    
        if ($cartItemsCount == 0) {
            // Jika cart kosong, berikan notifikasi atau arahkan kembali
            return redirect()->route('cart.index')->with('error', 'Cart kosong. Tidak dapat melakukan booking.');
        }
    
        // Periksa apakah status cart adalah 'Belum Memesan'
        if ($cart->status == 'Belum Memesan') {
            // Update status cart menjadi 'Menunggu Konfirmasi'
            $cart->status = 'Menunggu Konfirmasi';
            $cart->save();
    
            return redirect()->route('cart.index')->with('success', 'Cart berhasil di-booking, menunggu konfirmasi.');
        }
    
        // Jika status bukan 'Belum Memesan', beri pesan bahwa cart sudah di-booking
        return redirect()->route('cart.index')->with('info', 'Gagal booking.');
    }
     
}
