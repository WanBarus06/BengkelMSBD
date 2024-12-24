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
            CREATE TRIGGER log_insert_purchase_invoice
            AFTER INSERT ON purchase_invoices
            FOR EACH ROW 
            BEGIN
                INSERT INTO logs (action_type, table_name, record_id, new_value, user_id, created_at, updated_at)
                VALUES 
                ("INSERT", "purchase_invoices", NEW.invoice_id, CONCAT("Staff ID: ", NEW.staff_id, ", Supplier ID: ", NEW.supplier_id), NEW.staff_id, NOW(), NOW());
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
