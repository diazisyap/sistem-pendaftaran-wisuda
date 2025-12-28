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
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->integer('jumlah_kursi_tambahan')->default(0);
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['belum_bayar', 'menunggu_verifikasi', 'lunas', 'ditolak'])->default('belum_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['jumlah_kursi_tambahan', 'bukti_pembayaran', 'status_pembayaran']);
        });
    }
};
