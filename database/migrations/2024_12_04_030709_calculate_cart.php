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
            CREATE FUNCTION cartTotal(cartId INT)
            RETURNS DECIMAL(10, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total DECIMAL(10, 2);
                
                SELECT SUM(quantity * price) 
                INTO total
                FROM cart_items
                WHERE cart_id = cartId;
                
                RETURN COALESCE(total, 0);
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS cartTotal;");
    }
};
