<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:pendaftaran,nim,' . Auth::id() . ',user_id',
            'prodi' => 'required|string|max:255',
            'judul_skripsi' => 'required|string|max:255',
            'pembimbing_1' => 'required|string|max:255',
            'pembimbing_2' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Pendaftaran::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nama_mahasiswa' => $request->nama,
                'nim' => $request->nim,
                'program_studi' => $request->prodi,
                'judul_skripsi' => $request->judul_skripsi,
                'pembimbing_1' => $request->pembimbing_1,
                'pembimbing_2' => $request->pembimbing_2,
                'email_aktif' => $request->email,
            ]
        );

        return redirect()->route('upload-berkas')->with('success', 'Data pendaftaran berhasil disimpan! Silakan lanjut upload dokumen.');
    }
}
