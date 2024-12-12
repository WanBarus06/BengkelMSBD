<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        // Ambil input pencarian dari query string
        $search = $request->input('search');
        $rowsPerPage = $request->input('rows_per_page', 10); // Default 10 rows per page

        // Query untuk mengambil data dengan filter status dan pencarian
        $orders = Cart::whereIn('status', ['Menunggu Pengambilan', 'Menunggu Konfirmasi'])
                    ->when($search, function ($query, $search) {
                        return $query->whereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%")
                                    ->orWhere('phone_number', 'like', "%{$search}%");
                        })
                        ->orWhere('status', 'like', "%{$search}%");
                    })
                    ->paginate($rowsPerPage); // Tambahkan pagination dengan rows per page

        // Tambahkan total_amount ke setiap order
        foreach ($orders as $order) {
            $orderTotal = DB::selectOne('SELECT cartTotal(?) as total', [$order->id]);
            $order->total_amount = $orderTotal ? $orderTotal->total : 0; // Assign total_amount ke objek cart
        }

        // Kirim data ke view
        return view('staff.online-order', compact('orders'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($cartId)
    {
        // Ambil cart berdasarkan cartId
        $cart = Cart::findOrFail($cartId);

        // Ambil semua cart items yang terkait dengan cart ini beserta produk terkait
        $cartItems = CartItem::with('product')->where('cart_id', $cart->id)->get();

        // Menggunakan stored function untuk menghitung total
        $cartTotal = DB::selectOne("SELECT cartTotal(?) AS total", [$cart->id]);

        // Jika hasil total ada, assign ke cart
        $totalAmount = $cartTotal ? $cartTotal->total : 0;

        return view('staff.detail-order', compact('cart', 'cartItems', 'totalAmount'));
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
    public function destroy(Cart $cart)
    {
        //
    }

    public function confirmOrder(Cart $cart)
    {
        $cart->status = 'Menunggu Pengambilan';
        $cart->save();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function rejectOrder(Request $request, Cart $cart)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);
        $cart->update([
            'status' => 'Transaksi Gagal',
            'cancelled_reason' => $request->reason,
            'cancelled_by' => auth()->user()->id, // Ambil nama user yang membatalkan
            'rejected_at' => now()
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan telah berhasil ditolak');
    }

}
