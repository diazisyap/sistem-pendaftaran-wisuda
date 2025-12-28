<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'nama_mahasiswa',
        'nim',
        'program_studi',
        'judul_skripsi',
        'pembimbing_1',
        'pembimbing_2',
        'email_aktif',
        'fakultas',
        'ipk',
        'status',
        'qr_token',
        'qr_generated_at',
        'sektor_kursi',
        'kuota_tamu',
        'jumlah_kursi_tambahan',
        'bukti_pembayaran',
        'status_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function berkas()
    {
        return $this->hasOne(BerkasPersyaratan::class, 'pendaftaran_id');
    }
}
