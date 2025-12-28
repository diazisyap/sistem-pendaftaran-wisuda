<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiWisuda extends Model
{
    protected $table = 'sesi_wisuda';

    protected $fillable = [
        'nama_sesi',
        'tanggal',
        'waktu',
        'lokasi',
        'kuota',
        'status_sesi'
    ];
}
