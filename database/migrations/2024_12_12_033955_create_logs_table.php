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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->string('table_name', 50); // Nama tabel
            $table->unsignedBigInteger('record_id'); // ID data yang diubah
            $table->string('old_value', 255)->nullable(); // Nilai sebelum perubahan
            $table->string('new_value', 255)->nullable(); // Nilai setelah perubahan
            $table->unsignedBigInteger('user_id')->nullable(); // ID user
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
