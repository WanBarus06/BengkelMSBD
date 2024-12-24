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
            CREATE TRIGGER trigger_update_product_status
            AFTER UPDATE ON products
            FOR EACH ROW 
            BEGIN
                -- Cek jika status produk berubah menjadi inactive
                IF NEW.is_active = FALSE AND OLD.is_active = TRUE THEN
                    -- Hapus item dari cart_items yang berisi produk tersebut
                    DELETE FROM cart_items 
                    WHERE product_id = NEW.product_id;
                    
                    -- Jika cart tidak memiliki item lagi, hapus cart-nya
                    DELETE FROM carts 
                    WHERE id NOT IN (SELECT DISTINCT cart_id FROM cart_items);
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
