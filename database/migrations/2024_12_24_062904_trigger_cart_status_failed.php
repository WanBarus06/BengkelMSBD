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
            CREATE TRIGGER trigger_cart_status_failed
            AFTER UPDATE ON carts
            FOR EACH ROW 
            BEGIN
                -- Cek jika status berubah menjadi "Transaksi Gagal"
                IF NEW.status = "Transaksi Gagal" AND OLD.status != "Transaksi Gagal" THEN
                    -- Menyimpan log perubahan status cart ke "Transaksi Gagal"
                    INSERT INTO logs (action_type, table_name, record_id, old_value, new_value, user_id, created_at, updated_at)
                    VALUES 
                    ("UPDATE", "carts", OLD.id, OLD.status, NEW.status, NEW.cancelled_by, NOW(), NOW());
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
