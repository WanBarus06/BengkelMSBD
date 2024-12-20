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
        DB::statement("
        CREATE VIEW today_purchases AS
        SELECT 
            p.invoice_id AS purchase_id,
            p.supplier_id,
            s.supplier_name,
            p.staff_id,
            p.created_at,
            purchaseTotal(p.invoice_id) AS total
        FROM purchase_invoices p
        JOIN suppliers s ON p.supplier_id = s.supplier_id
        WHERE DATE(p.created_at) = CURDATE();
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS today_purchases");
    }
};
