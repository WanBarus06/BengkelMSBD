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
        CREATE VIEW today_sales AS
        SELECT 
            sr.sales_id AS sales_id,
            sr.customer_id,
            sr.offline_customer_name,
            sr.is_fully_paid,
            saleTotal(sr.sales_id) AS total
        FROM sales_records sr
        WHERE DATE(sr.created_at) = CURDATE();
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS today_sales");
    }
};
