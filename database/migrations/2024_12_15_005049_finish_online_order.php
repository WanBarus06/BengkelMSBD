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
        CREATE PROCEDURE CompleteOrder(IN cartId INT)
        BEGIN
            -- Deklarasi variabel
            DECLARE customerId INT;
            DECLARE approved_at TIMESTAMP;
            DECLARE salesRecordId INT;

            -- Mulai transaksi
            START TRANSACTION;

            -- 1. Ambil customer_id dan approved_at dari cart
            SELECT user_id, NOW() INTO customerId, approved_at FROM carts WHERE id = cartId;

            -- Cek apakah cart ditemukan
            IF customerId IS NULL THEN
                ROLLBACK;  -- Jika cart tidak ditemukan, rollback transaksi
            ELSE
                -- 2. Buat sales record baru
                INSERT INTO sales_records (customer_id, is_fully_paid, created_at, updated_at)
                VALUES (customerId, TRUE, NOW(), NOW());

                -- Ambil ID dari sales record yang baru dibuat
                SET salesRecordId = LAST_INSERT_ID();

                -- 3. Proses setiap item dalam cart_items dan insert ke sales_record_details
                INSERT INTO sales_record_details (sales_id, product_id, quantity, price_per_unit, created_at, updated_at)
                SELECT 
                    salesRecordId, 
                    ci.product_id, 
                    ci.quantity, 
                    ci.price, 
                    NOW(), 
                    NOW()
                FROM cart_items ci
                WHERE ci.cart_id = cartId;

                -- Cek apakah ada item yang gagal diproses
                IF ROW_COUNT() = 0 THEN
                    ROLLBACK;  -- Jika tidak ada item yang berhasil diproses, rollback transaksi
                ELSE
                    -- 4. Ubah status cart menjadi "Transaksi Selesai" dan update approved_at serta expired_at
                    UPDATE carts 
                    SET 
                        status = "Transaksi Selesai", 
                        approved_at = approved_at
                    WHERE id = cartId;

                    -- Cek apakah update status cart berhasil
                    IF ROW_COUNT() = 0 THEN
                        ROLLBACK;  -- Jika status cart tidak berhasil diubah, rollback transaksi
                    ELSE
                        -- 5. Commit transaksi jika semua langkah berhasil
                        COMMIT;
                    END IF;
                END IF;
            END IF;
        END
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
