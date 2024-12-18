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
            DECLARE insufficient_stock BOOLEAN DEFAULT FALSE;

            -- Mulai transaksi
            START TRANSACTION;

            -- 1. Ambil customer_id dan approved_at dari cart
            SELECT user_id, NOW() INTO customerId, approved_at FROM carts WHERE id = cartId;

            -- Cek apakah cart ditemukan
            IF customerId IS NULL THEN
                ROLLBACK;  -- Jika cart tidak ditemukan, rollback transaksi
            ELSE
                -- 2. Validasi stok produk
                -- Jika stok kurang dari kuantitas item di cart, set insufficient_stock menjadi TRUE
                SELECT 
                    COUNT(*) 
                INTO insufficient_stock
                FROM cart_items ci
                JOIN product_details p ON ci.product_id = p.product_id
                WHERE ci.cart_id = cartId
                AND p.stock < ci.quantity;

                -- Jika ada produk dengan stok tidak cukup, rollback
                IF insufficient_stock > 0 THEN
                    ROLLBACK;
                ELSE
                    -- 3. Buat sales record baru
                    INSERT INTO sales_records (customer_id, is_fully_paid, created_at, updated_at)
                    VALUES (customerId, TRUE, NOW(), NOW());

                    -- Ambil ID dari sales record yang baru dibuat
                    SET salesRecordId = LAST_INSERT_ID();

                    -- 4. Proses setiap item dalam cart_items dan insert ke sales_record_details
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

                    -- 5. Update stok produk
                    UPDATE product_details p
                    JOIN cart_items ci ON p.product_id = ci.product_id
                    SET p.stock = p.stock - ci.quantity
                    WHERE ci.cart_id = cartId;

                    -- 6. Ubah status cart menjadi "Transaksi Selesai" dan update approved_at
                    UPDATE carts 
                    SET 
                        status = "Transaksi Selesai", 
                        approved_at = approved_at
                    WHERE id = cartId;

                    -- Commit transaksi
                    COMMIT;
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
        DB::unprepared('DROP PROCEDURE IF EXISTS CompleteOrder');
    }
};
