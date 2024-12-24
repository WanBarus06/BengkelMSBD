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
            CREATE FUNCTION sales_record_detail()
            RETURNS DECIMAL(20,2)
            DETERMINISTIC
            BEGIN
                DECLARE total DECIMAL(20,2);

                SELECT IFNULL(SUM(d.quantity * d.price_per_unit), 0) INTO total
                FROM sales_records r
                INNER JOIN sales_record_details d ON r.sales_id = d.sales_id;

                RETURN total;
            END;
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
