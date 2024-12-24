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
            CREATE TRIGGER log_insert_sales_record
            AFTER INSERT ON sales_records
            FOR EACH ROW 
            BEGIN
                INSERT INTO logs (action_type, table_name, record_id, new_value, user_id, created_at, updated_at)
                VALUES 
                ("INSERT", "sales_records", NEW.sales_id, CONCAT("Customer ID: ", NEW.customer_id, ", Staff ID: ", NEW.staff_id), NEW.staff_id, NOW(), NOW());
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
