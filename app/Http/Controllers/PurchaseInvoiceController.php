<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PurchaseInvoiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::firstOrCreate(['status' => "Belum Memesan", 'user_id' => auth()->id()]);

        // 2. Ambil item yang sudah dimasukkan ke cart
        $cartItems = $cart->cartItems()->with('product')->get();

        // 3. Ambil data supplier dan produk
        $suppliers = Supplier::where('is_active', 1)->get();
        $products = Product::where('is_active', 1)->get();

        return view('staff.add-purchase-invoice', compact('cart', 'cartItems', 'suppliers', 'products'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $cart_id)
    {
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
            // Jika produk belum ada di cart, tambahkan sebagai item baru
            CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->product_id,
            'quantity' => $request->quantity,
            'price' => $product->productDetail->product_sell_price,
            ]);
        }

        return redirect()->route('purchase-invoice.index')->with('success', 'Produk berhasil ditambahkan ke cart.');
    }


    /**
     * Display the specified resource.
     */
    public function show(PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        //
    }
    
    public function confirmInvoice(Request $request, $cartId)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
        ]);
        
        $staffId = Auth::id();
        $supplierId = $request->input('supplier_id');
        
    
        try {
            // Memanggil stored procedure yang telah dibuat
            DB::statement('CALL ConfirmPurchaseInvoice(?, ?, ?)', [$cartId, $supplierId, $staffId]);
    
            return redirect()->route('orders.index')->with('success', 'Purchase Invoice confirmed successfully.');
        } catch (\Exception $e) {
            \Log::error('Error while calling stored procedure: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}
