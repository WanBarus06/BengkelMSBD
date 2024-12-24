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
            CREATE TRIGGER update_sales_record_status
            AFTER UPDATE ON sales_records
            FOR EACH ROW 
            BEGIN
                -- Cek apakah is_fully_paid berubah menjadi TRUE
                IF OLD.is_fully_paid != TRUE AND NEW.is_fully_paid = TRUE THEN
                    INSERT INTO logs (action_type, table_name, record_id, old_value, new_value, user_id, created_at, updated_at)
                    VALUES 
                    ("UPDATE", "sales_records", NEW.sales_id, 
                     CONCAT("is_fully_paid: ", OLD.is_fully_paid), 
                     CONCAT("is_fully_paid: ", NEW.is_fully_paid), 
                     NEW.staff_id, NOW(), NOW());
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
