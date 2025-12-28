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
        Schema::table('berkas_persyaratan', function (Blueprint $table) {
            $docs = ['foto_formal', 'foto_bebas', 'surat_pernyataan', 'transkip_nilai', 'krs_terpenuhi'];
            foreach ($docs as $doc) {
                $table->enum('status_' . $doc, ['pending', 'terverifikasi', 'revisi'])->default('pending');
                $table->text('catatan_' . $doc)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas_persyaratan', function (Blueprint $table) {
            //
        });
    }
};
