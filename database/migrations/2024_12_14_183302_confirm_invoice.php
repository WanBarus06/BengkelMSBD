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
              // Menulis stored procedure langsung tanpa DELIMITER
              DB::statement('
            CREATE PROCEDURE ConfirmPurchaseInvoice(IN cartId INT, IN supplierId INT)
            BEGIN
                -- Deklarasi variabel untuk purchaseInvoiceId
                DECLARE purchaseInvoiceId INT;

                -- Mulai transaksi
                START TRANSACTION;

                -- 1. Buat Purchase Invoice baru
                INSERT INTO purchase_invoices (supplier_id, invoice_date, created_at, updated_at)
                VALUES (supplierId, NOW(), NOW(), NOW());

                -- Ambil ID dari purchase_invoice yang baru saja dibuat
                SET purchaseInvoiceId = LAST_INSERT_ID();

                -- 2. Masukkan data ke purchase_invoice_details dari cart_items
                INSERT INTO purchase_invoice_details (invoice_id, product_id, quantity, unit_price, created_at, updated_at)
                SELECT
                    purchaseInvoiceId, 
                    product_id, 
                    quantity, 
                    price, 
                    NOW(), 
                    NOW()
                FROM cart_items
                WHERE cart_id = cartId;

                -- 3. Update stok di product_details
                UPDATE product_details pd
                JOIN cart_items ci ON pd.product_id = ci.product_id
                SET pd.stock = pd.stock + ci.quantity
                WHERE ci.cart_id = cartId;

                -- 4. Hapus cart setelah semua item diproses
                DELETE FROM carts WHERE id = cartId;

                -- Commit transaksi
                COMMIT;
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
