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
        CREATE PROCEDURE ConfirmOrder(IN cartId INT)
        BEGIN
            -- Deklarasi variabel
            DECLARE customerId INT;
            DECLARE approved_at TIMESTAMP;
            DECLARE pickupCode VARCHAR(50);

            -- Mulai transaksi
            START TRANSACTION;

            -- 1. Ambil customer_id dan approved_at dari cart
            SELECT user_id, NOW() INTO customerId, approved_at FROM carts WHERE id = cartId;

            -- Cek apakah cart ditemukan
            IF customerId IS NULL THEN
                ROLLBACK;  -- Jika cart tidak ditemukan, rollback transaksi
            ELSE
                -- 2. Generate pickup code (misalnya UUID atau kombinasi acak)
                SET pickupCode = CONCAT("PKP-", LEFT(UUID(), 8));  -- Contoh: PKP-xxxxxxxx

                -- 3. Ubah status cart menjadi "Menunggu Pengambilan" dan update expired_at
                UPDATE carts 
                SET 
                    status = "Menunggu Pengambilan", 
                    expired_at = DATE_ADD(approved_at, INTERVAL 2 DAY),
                    pickup_code = pickupCode,
                    updated_at = NOW() 
                WHERE id = cartId;

                -- Cek apakah status cart berhasil diubah
                IF ROW_COUNT() = 0 THEN
                    ROLLBACK;  -- Jika status cart tidak berhasil diubah, rollback transaksi
                ELSE
                    -- 4. Update stok produk berdasarkan cart items
                    UPDATE product_details pd
                    JOIN cart_items ci ON pd.product_id = ci.product_id
                    SET pd.stock = pd.stock - ci.quantity
                    WHERE ci.cart_id = cartId;

                    -- Cek apakah update stok berhasil
                    IF ROW_COUNT() = 0 THEN
                        ROLLBACK;  -- Jika stok tidak berhasil diperbarui, rollback transaksi
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
        DB::unprepared('DROP PROCEDURE IF EXISTS ConfirmOrder');
    }
};
