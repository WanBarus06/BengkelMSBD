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
        DB::statement('
        CREATE EVENT IF NOT EXISTS CheckExpiredCart
        ON SCHEDULE EVERY 1 HOUR -- Menjalankan setiap jam
        COMMENT "Memeriksa cart yang sudah expired dan mengubah status menjadi transaksi gagal serta mengembalikan stok produk"
        DO
        BEGIN
            -- Update cart yang sudah expired dan statusnya "Menunggu Pengambilan"
            UPDATE carts c
            JOIN cart_items ci ON c.id = ci.cart_id
            JOIN product_details pd ON pd.product_id = ci.product_id
            SET c.status = "Transaksi Gagal", 
                pd.stock = pd.stock + ci.quantity -- Mengembalikan stok produk
            WHERE c.status = "Menunggu Pengambilan" 
            AND c.expired_at < NOW(); -- Cart sudah expired

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
