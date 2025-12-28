<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPersyaratan extends Model
{
    protected $table = 'berkas_persyaratan';

    protected $fillable = [
        'pendaftaran_id',
        'foto_formal', 'status_foto_formal', 'catatan_foto_formal',
        'foto_bebas', 'status_foto_bebas', 'catatan_foto_bebas',
        'surat_pernyataan', 'status_surat_pernyataan', 'catatan_surat_pernyataan',
        'transkip_nilai', 'status_transkip_nilai', 'catatan_transkip_nilai',
        'krs_terpenuhi', 'status_krs_terpenuhi', 'catatan_krs_terpenuhi'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
