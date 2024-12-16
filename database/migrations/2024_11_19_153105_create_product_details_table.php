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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->integer('stock');
            $table->integer('warning_stock');
            $table->integer('product_sell_price');
            $table->timestamps();
        });

        DB::statement("
        ALTER TABLE product_details 
        ADD CONSTRAINT check_stock_non_negative 
        CHECK (stock >= 0);
        ");

        
        DB::statement("
        ALTER TABLE product_details 
        ADD CONSTRAINT check_warning_stock_valid 
        CHECK (warning_stock >= 0 AND warning_stock <= stock);
        ");

        DB::statement("
        ALTER TABLE product_details 
        ADD CONSTRAINT check_product_sell_price 
        CHECK (product_sell_price >= 0);
        ");
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
