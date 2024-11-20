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
        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->id('description_id');
            $table->foreignId('size_id')->constrained('sizes', 'size_id')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands', 'brand_id')->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('variants', 'variant_id')->onDelete('cascade');
            $table->string('product_description');
            $table->string('product_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_descriptions');
    }
};
