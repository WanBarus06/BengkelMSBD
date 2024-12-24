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
        DB::statement('
            CREATE OR REPLACE VIEW top_products AS
            SELECT 
                p.product_id,
                p.product_name,
                pd.stock AS total_stock,
                pd.product_sell_price AS sell_price
            FROM products AS p
            JOIN product_details AS pd 
            ON p.product_id = pd.product_id
            WHERE p.is_active = 1
            ORDER BY pd.stock DESC;
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
