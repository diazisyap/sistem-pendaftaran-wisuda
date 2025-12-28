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
        Schema::table('sesi_wisuda', function (Blueprint $table) {
            if (!Schema::hasColumn('sesi_wisuda', 'nama_sesi')) {
                $table->string('nama_sesi')->nullable();
                $table->date('tanggal')->nullable();
                $table->string('waktu')->nullable();
                $table->string('lokasi')->nullable();
                $table->integer('kuota')->nullable();
                $table->enum('status_sesi', ['aktif', 'nonaktif'])->default('aktif');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sesi_wisuda', function (Blueprint $table) {
            //
        });
    }
};
