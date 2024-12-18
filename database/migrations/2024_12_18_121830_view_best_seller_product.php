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
        CREATE OR REPLACE VIEW top_products_sales AS
        SELECT 
            p.product_id,
            p.product_name,
            SUM(srd.quantity) AS total_quantity_sold
        FROM 
            sales_record_details AS srd
        JOIN 
            products AS p ON srd.product_id = p.product_id
        GROUP BY 
            p.product_id, p.product_name
        ORDER BY 
            total_quantity_sold DESC
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS top_products_sales');
    }
};
