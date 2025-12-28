<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('berkas_persyaratan', function (Blueprint $table) {
           $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->string('foto_formal')->nullable();
            $table->string('foto_bebas')->nullable();
            $table->string('surat_pernyataan')->nullable();
            $table->string('transkip_nilai')->nullable();
            $table->string('krs_terpenuhi')->nullable();
            $table->timestamps();

        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('berkas_persyaratan');
    }
};
