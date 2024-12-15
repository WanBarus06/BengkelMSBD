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
        DB::unprepared("
            CREATE PROCEDURE CompleteOfflineOrder(
                IN cartId INT,
                IN offlineCustomerName VARCHAR(255),
                IN offlineCustomerPhoneNumber VARCHAR(15),
                IN offlineCustomerAddress TEXT,
                IN isFullyPaid BOOLEAN
            )
            BEGIN
                DECLARE salesRecordId INT;

                -- Mulai transaksi
                START TRANSACTION;

                -- 1. Insert data ke tabel sales_records
                INSERT INTO sales_records (offline_customer_name, offline_customer_phone_number, offline_customer_address, is_fully_paid, created_at, updated_at)
                VALUES (offlineCustomerName, offlineCustomerPhoneNumber, offlineCustomerAddress, isFullyPaid, NOW(), NOW());

                -- Ambil ID dari sales_record yang baru dibuat
                SET salesRecordId = LAST_INSERT_ID();

                -- 2. Insert data ke sales_record_details berdasarkan cart_items
                INSERT INTO sales_record_details (sales_id, product_id, quantity, price_per_unit, created_at, updated_at)
                SELECT salesRecordId, product_id, quantity, price, NOW(), NOW()
                FROM cart_items
                WHERE cart_id = cartId;

                -- 3. Update stok produk berdasarkan cart_items
                UPDATE product_details pd
                JOIN cart_items ci ON pd.product_id = ci.product_id
                SET pd.stock = pd.stock - ci.quantity
                WHERE ci.cart_id = cartId;

                -- 4. Hapus cart_items dari cart
                DELETE FROM cart_items WHERE cart_id = cartId;

                -- 5. Hapus cart
                DELETE FROM carts WHERE id = cartId;

                -- Jika tidak ada error, commit transaksi
                COMMIT;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
