<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasPersyaratan;
use Illuminate\Support\Facades\Auth;

class BerkasController extends Controller
{
    public function index()
    {
        return view('berkas.index');
    }

    public function store(Request $request)
    {
        $pendaftaran = Auth::user()->pendaftaran;
        $berkas = BerkasPersyaratan::where('pendaftaran_id', $pendaftaran->id)->first();

        $rules = [
            'foto_formal' => ($berkas && $berkas->foto_formal) ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'foto_bebas' => ($berkas && $berkas->foto_bebas) ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'surat_pernyataan' => ($berkas && $berkas->surat_pernyataan) ? 'nullable|mimes:pdf|max:4096' : 'required|mimes:pdf|max:4096',
            'transkip_nilai' => ($berkas && $berkas->transkip_nilai) ? 'nullable|mimes:pdf|max:4096' : 'required|mimes:pdf|max:4096',
            'krs_terpenuhi' => ($berkas && $berkas->krs_terpenuhi) ? 'nullable|mimes:pdf,pptx|max:5120' : 'required|mimes:pdf,pptx|max:5120',
        ];

        $messages = [
            'required' => 'Kolom :attribute wajib diisi!',
            'image' => 'File harus berupa gambar (JPG/PNG).',
            'mimes' => 'Format file tidak sesuai (Gunakan PDF/PPTX).',
            'max' => 'Ukuran file maksimal :max KB.',
        ];

        $request->validate($rules, $messages);

        
        $pendaftaran = Auth::user()->pendaftaran;

        $berkas = BerkasPersyaratan::firstOrCreate([
            'pendaftaran_id' => $pendaftaran->id
        ]);

        foreach ([
            'foto_formal',
            'foto_bebas',
            'surat_pernyataan',
            'transkip_nilai',
            'krs_terpenuhi'
        ] as $file) 
        {
            if ($request->hasFile($file)) {
                $berkas->$file = $request->file($file)->store('berkas', 'public');
            }
        }

        $berkas->save();

        return redirect()->route('pembayaran')->with('success', 'Berkas berhasil diupload. Silakan lanjutkan ke pembayaran.');
    }
}
