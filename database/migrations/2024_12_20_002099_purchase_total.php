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
        CREATE FUNCTION purchaseTotal(invoice_id INT)
        RETURNS DECIMAL(10, 2)
        DETERMINISTIC
        BEGIN
            DECLARE total DECIMAL(10, 2);
            
            SELECT SUM(quantity * unit_price) 
            INTO total
            FROM purchase_invoice_details
            WHERE invoice_id = invoice_id;
            
            RETURN COALESCE(total, 0);
        END;
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS purchaseTotal");
    }
};
