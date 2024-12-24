<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE PROCEDURE laporan_penjualan()
            BEGIN
                SELECT 
                    r.sales_id AS ID_Penjualan,
                    IFNULL(r.offline_customer_name, "Customer Online") AS Nama_Pelanggan,
                    IFNULL(r.offline_customer_phone_number, "-") AS Nomor_Telepon,
                    IFNULL(r.offline_customer_address, "-") AS Alamat_Pelanggan,
                    r.created_at AS Tanggal_Penjualan,
                    sales_record_detail_total(r.sales_id) AS Total_Harga_Penjualan
                FROM sales_records r
                ORDER BY r.created_at DESC;

                SELECT 
                    "Total Keseluruhan Penjualan" AS Keterangan,
                    sales_record_detail() AS Total_Seluruh_Penjualan;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
