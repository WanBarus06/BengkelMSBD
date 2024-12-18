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
        CREATE PROCEDURE MarkSaleAsPaid(IN saleId INT)
        BEGIN
            -- Perbarui status is_fully_paid menjadi TRUE
            UPDATE sales_records
            SET is_fully_paid = TRUE, updated_at = NOW()
            WHERE sales_id = saleId;
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS MarkSaleAsPaid');
    }
};
