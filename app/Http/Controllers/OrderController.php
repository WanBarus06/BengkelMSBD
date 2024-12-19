<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SalesRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
{
    // Ambil input pencarian dan filter sort dari query string
    $search = $request->input('search');
    $rowsPerPage = $request->input('rows_per_page', 10); // Default 10 rows per page
    $sortBy = $request->input('sort_by', 'created_at'); // Default sorting berdasarkan waktu (updated_at)
    $sortOrder = $request->input('sort_order', 'desc'); // Default sorting DESC (terbaru)

    // Query untuk mengambil data dengan filter status dan pencarian
    $orders = Cart::whereIn('status', ['Menunggu Pengambilan', 'Menunggu Konfirmasi'])
                ->when($search, function ($query, $search) {
                    return $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                                ->orWhere('phone_number', 'like', "%{$search}%");
                    })
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('pickup_code', 'like', "%{$search}%")
                    ;
                })
                // Sorting berdasarkan parameter yang diterima
                ->orderBy($sortBy, $sortOrder) // Sorting berdasarkan kolom dan arah
                ->paginate($rowsPerPage); // Tambahkan pagination dengan rows per page

    // Tambahkan total_amount ke setiap order
    foreach ($orders as $order) {
        $orderTotal = DB::selectOne('SELECT cartTotal(?) as total', [$order->id]);
        $order->total_amount = $orderTotal ? $orderTotal->total : 0; // Assign total_amount ke objek cart
    }

    // Kirim data ke view
    return view('staff.online-order', compact('orders', 'sortBy', 'sortOrder'));
}


    public function create()
    {
        
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

    public function completeOrder(Request $request, $cartId)
    {
        $staffId = Auth::id();
        try {
            // Memanggil stored procedure
            DB::statement('CALL CompleteOrder(:cartId, :StaffId)', ['cartId' => $cartId, 'StaffId' => $staffId]);
            return redirect()->route('orders.index')->with('success', 'Pesanan telah selesai.');
        } catch (\Exception $e) {
            // Tangani kesalahan
            \Log::error('Error while calling stored procedure: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function confirmOrder(Cart $cart)
    {   
        DB::statement('CALL ConfirmOrder(:cartId)', ['cartId' => $cart->id]);

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

    public function indexOnsite(Request $request)
    {
        // Ambil input pencarian dan filter sort dari query string
        $search = $request->input('search');
        $rowsPerPage = $request->input('rows_per_page', 10);
        $sortBy = $request->input('sort_by', 'sales_id'); // Default sorting berdasarkan ID
        $sortOrder = $request->input('sort_order', 'desc');

        // Query untuk data Onsite Orders
        $onsiteOrders = SalesRecord::whereNull('customer_id') // Hanya untuk customer_id kosong
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('offline_customer_name', 'like', "%{$search}%")
                    ->orWhere('offline_customer_phone_number', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('phone_number', 'like', "%{$search}%");
                    });
            });
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate($rowsPerPage);
    



        return view('staff.onsite-order', compact('onsiteOrders', 'sortBy', 'sortOrder'));
    }

    public function createOrGetCart(Request $request)
    {
        // Get the current authenticated user
        $user = auth()->user();

        // Periksa apakah ada cart dengan status "Menunggu Pemesanan" untuk user ini
        $existingCart = Cart::where('user_id', $user->id)
                            ->where('status', 'Belum Memesan')
                            ->first();
    
        if (!$existingCart) {
            // Buat cart baru jika belum ada
            $existingCart = Cart::create([
                'user_id' => $user->id,
                'status' => 'Belum Memesan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        // Redirect ke halaman pembuatan pesanan offline
        return redirect()->route('offline-orders.index', ['cartId' => $existingCart->id])
                         ->with('info', 'Silakan tambahkan item ke dalam cart.');
    }


    

}
