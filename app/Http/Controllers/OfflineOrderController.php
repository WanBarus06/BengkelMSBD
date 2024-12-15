<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\SalesRecord;
use App\Models\SalesRecordDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfflineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil user yang sedang login
    $user = auth()->user();

    // Ambil cart yang statusnya "Menunggu Pemesanan" untuk user ini
    $cart = Cart::where('user_id', $user->id)
                ->where('status', 'Belum Memesan')
                ->with('cartItems.product') // Eager load untuk mengurangi query ke database
                ->first();

    // Jika tidak ada cart, redirect ke halaman lain (atau buat cart baru jika diperlukan)
    if (!$cart) {
        return redirect()->route('orders.createOrGetCart')->with('warning', 'Belum ada cart aktif.');
    }

    // Ambil data produk untuk dropdown
    $products = Product::all();

    // Ambil item dalam cart
    $cartItems = $cart->cartItems;

    // Tampilkan halaman dengan data
    return view('staff.add-offline-order', compact('cart', 'cartItems', 'products'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $cart_id)
{
    // Validasi input
    $request->validate([
        'product_id' => 'required|exists:products,product_id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Ambil produk berdasarkan ID yang dipilih
    $product = Product::with('productDetail')->findOrFail($request->product_id);

    // Ambil cart berdasarkan ID yang diberikan
    $cart = Cart::findOrFail($cart_id);

    // Periksa apakah produk sudah ada di cart
    $cartDetail = CartItem::where('cart_id', $cart->id)
    ->where('product_id', $product->product_id)
    ->first(); // Ambil satu data

    if ($cartDetail) {
    // Jika produk sudah ada di cart, update kuantitas dan harga
        if ($cartDetail->quantity + $request->quantity > $product->productDetail->stock) {
        return redirect()->route('offline-orders.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        $cartDetail->quantity += $request->quantity; // tambah kuantitas
        $cartDetail->price = $product->productDetail->product_sell_price; // update harga terbaru
        $cartDetail->save();
    } else {
        if ($request->quantity > $product->productDetail->stock) {
            return redirect()->route('offline-orders.index')->with('error', 'Jumlah produk melebihi stok yang tersedia.');
            }
        CartItem::create([
        'cart_id' => $cart->id,
        'product_id' => $product->product_id,
        'quantity' => $request->quantity,
        'price' => $product->productDetail->product_sell_price,
        ]);
    }


    // Redirect atau kembali ke halaman cart untuk melihat isi keranjang
    return redirect()->route('offline-orders.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

    /**
     * Display the specified resource.
     */
    public function show($salesId)
    {
        // Ambil cart berdasarkan cartId
        $sale = SalesRecord::findOrFail($salesId);

        // Ambil semua cart items yang terkait dengan cart ini beserta produk terkait
        $cartItems = SalesRecordDetail::with('product')->where('sales_id', $sale->sales_id)->get();

        // Menggunakan stored function untuk menghitung total
        $cartTotal = DB::selectOne("SELECT saleTotal(?) AS total", [$sale->sales_id]);

        // Jika hasil total ada, assign ke cart
        $totalAmount = $cartTotal ? $cartTotal->total : 0;

        return view('staff.detail-penjualan', compact('sale', 'cartItems', 'totalAmount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartId)
    {
        try {
            $cart = Cart::findOrFail($cartId);
    
            // Hapus semua item dalam cart
            $cart->cartItems()->delete();
    
            // Hapus cart itu sendiri
            $cart->delete();
    
            return redirect()->route('orders.onsite')->with('success', 'Keranjang berhasil dibatalkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function completeOrder(Request $request, $cartId)
    {
        $request->validate([
            'offline_customer_name' => 'required|string|max:255',
            'offline_customer_phone_number' => 'required|string|max:15',
            'offline_customer_address' => 'required|string',
            'is_fully_paid' => 'required|boolean',
        ]);
    
        try {
            // Panggil stored procedure dengan DB::unprepared
            DB::statement("CALL CompleteOfflineOrder(:cartId, :offlineCustomerName, :offlineCustomerPhoneNumber, :offlineCustomerAddress, :isFullyPaid)", [
                'cartId' => $cartId,
                'offlineCustomerName' => $request->offline_customer_name,
                'offlineCustomerPhoneNumber' => $request->offline_customer_phone_number,
                'offlineCustomerAddress' => $request->offline_customer_address,
                'isFullyPaid' => $request->is_fully_paid,
            ]);
    
            return redirect()->route('orders.onsite')->with('success', 'Pesanan offline berhasil diselesaikan.');
        } catch (\Exception $e) {
            return redirect()->route('orders.onsite')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function paid($saleId)
    {
        DB::statement('CALL MarkSaleAsPaid(?)', [$saleId]);
        return redirect()->route('orders.onsite')->with('success', 'Pesanan berhasil dibayar.');
    }


}
