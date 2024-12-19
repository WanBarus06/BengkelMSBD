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
        Schema::create('sales_records', function (Blueprint $table) {
            $table->id('sales_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable(); // Untuk pelanggan online
            $table->string('offline_customer_name')->nullable();  // Untuk pelanggan offline
            $table->string('offline_customer_phone_number')->nullable();  // Untuk pelanggan offline
            $table->string('offline_customer_address')->nullable();  // Untuk pelanggan offline
            $table->boolean('is_fully_paid')->default(true);
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_records');
    }
};
