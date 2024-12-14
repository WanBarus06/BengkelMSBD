<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB; 

class dashboardOwnerController extends Controller
{
    public function dashboardOwner()
    {
        // Ambil data pengguna, pegawai, dan produk
        $jumlahPengguna = User::where('role', 'user')->where('is_active', '1')->count();
        $jumlahPegawai = User::where('role', 'staff')->where('is_active', '1')->count();
        $jumlahProduk = Product::where('is_active', '1')->count();
    
        $dataPenjualan = DB::table('sales_record_details AS srd')
        ->join('sales_records AS sr', 'srd.sales_record_id', '=', 'sr.id')
        ->join('products AS p', 'srd.product_id', '=', 'p.product_id') // Sesuaikan dengan kolom 'product_id'
        ->select(
            'sr.id AS invoice',
            'p.product_name AS nama_produk',
            'srd.price AS harga',
            'srd.quantity AS total_qty',
            DB::raw('srd.quantity * srd.price AS total_pesanan')
        )
        ->orderBy('sr.id', 'desc')
        ->get();
    
        // Ambil jumlah penjualan harian
        $penjualanHarian = DB::table('sales_record_details')
            ->select(DB::raw('DAYNAME(created_at) as hari'), DB::raw('SUM(quantity) as total'))
            ->groupBy(DB::raw('DAYNAME(created_at)'))
            ->orderByRaw("FIELD(DAYNAME(created_at), 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->pluck('total', 'hari');
    
        return view('dashboard-owner', compact(
            'jumlahPengguna',
            'jumlahPegawai',
            'jumlahProduk',
            'penjualanHarian',
            'dataPenjualan' // Kirim variabel ini ke view
        ));
    }    
}
