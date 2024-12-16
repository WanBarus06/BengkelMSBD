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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Menunggu Konfirmasi', 'Menunggu Pengambilan', 'Belum Memesan', 'Transaksi Selesai', 'Transaksi Gagal'])->default('Belum Memesan');
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('cancelled_reason')->nullable();
            $table->timestamp('approved_at')->nullable(); // Waktu ketika disetujui
            $table->timestamp('rejected_at')->nullable(); // Waktu ketika ditolak
            $table->timestamp('expired_at')->nullable(); // Batas waktu pesanan
            $table->string('pickup_code')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
