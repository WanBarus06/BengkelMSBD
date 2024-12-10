<?php
namespace App\Http\Controllers;

use App\Models\Cart;
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
}
