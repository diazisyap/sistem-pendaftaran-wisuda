<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_mahasiswa');
            $table->string('nim')->unique();
            $table->string('program_studi');
            $table->string('judul_skripsi');
            $table->string('pembimbing_1');
            $table->string('pembimbing_2');
            $table->string('email_aktif');
            $table->string('fakultas')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
