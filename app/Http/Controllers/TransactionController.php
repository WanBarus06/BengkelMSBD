<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    public function index()
    {
        // Ambil semua cart yang terkait dengan user yang sudah memiliki status selain 'Belum Memesan'
        $transactions = Cart::where('user_id', Auth::id())
            ->whereIn('status', ['Menunggu Konfirmasi', 'Transaksi Selesai', 'Transaksi Gagal', 'Menunggu Pengambilan']) // Atau status lainnya
            ->get();

        // Ambil total menggunakan stored function
        foreach ($transactions as $transaction) {
            // Panggil stored function untuk menghitung total transaksi berdasarkan cart_id
            $transactionTotal = DB::select("SELECT cartTotal(?) AS total", [$transaction->id]);
            $transaction->total = $transactionTotal[0]->total; // Set total ke property transaction
        }

        // Kirimkan data transaksi ke view
        return view('transaction', compact('transactions'));
    }

    public function show($cartId)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // redirect ke halaman login jika user belum login
        }

        $cart = Cart::where('id', $cartId)->first();
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
}
