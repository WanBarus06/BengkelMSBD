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
        // Data untuk ringkasan dashboard
        $jumlahPengguna = User::where('role', 'user')->where('is_active', '1')->count();
        $jumlahPegawai = User::where('role', 'staff')->where('is_active', '1')->count();
        $jumlahProduk = Product::where('is_active', '1')->count();

        $penjualanHarian = DB::table('sales_record_details')
        ->select(DB::raw("
            CASE DAYOFWEEK(created_at)
                WHEN 1 THEN 'Minggu'
                WHEN 2 THEN 'Senin'
                WHEN 3 THEN 'Selasa'
                WHEN 4 THEN 'Rabu'
                WHEN 5 THEN 'Kamis'
                WHEN 6 THEN 'Jumat'
                WHEN 7 THEN 'Sabtu'
            END as hari
        "), DB::raw('SUM(quantity) as total'))
        ->groupBy('hari')
        ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
        ->pluck('total', 'hari')
        ->toArray();

        // Lengkapi hari dengan data 0 jika tidak ada
        $defaultDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $penjualanHarian = array_merge(array_fill_keys($defaultDays, 0), $penjualanHarian);

        // Ambil 10 produk teratas dari view
        $topProducts = DB::table('top_products_sales')
                        ->orderBy('total_quantity_sold', 'desc')
                        ->take(10)
                        ->get();

        // Data untuk laporan penjualan
        $dataPenjualanArray = [];
        $totalKeseluruhanPenjualan = 0;

        try {
            // Koneksi ke database menggunakan PDO
            $pdo = DB::connection()->getPdo();
            $stmt = $pdo->query("CALL laporan_penjualan()");
            
            // Ambil result set pertama: Data penjualan
            $dataPenjualanArray = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
            // Pindah ke result set kedua: Total keseluruhan penjualan
            $stmt->nextRowset();
            $totalData = $stmt->fetch(\PDO::FETCH_ASSOC);
            $totalKeseluruhanPenjualan = $totalData['Total_Seluruh_Penjualan'] ?? 0;
        
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            report($e);
            $dataPenjualanArray = [];
            $totalKeseluruhanPenjualan = 0;
        }        

        // Kirim data ke view
        return view('dashboard-owner', compact(
            'jumlahPengguna',
            'jumlahPegawai',
            'jumlahProduk',
            'penjualanHarian',
            'dataPenjualanArray',
            'topProducts',
            'totalKeseluruhanPenjualan'
        ));
    }
}