<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $pendaftaran = Pendaftaran::with('berkas')->where('user_id', Auth::id())->first();
        return view('dashboard.dashboard_mahasiswa', compact('pendaftaran'));
    }

    public function pendaftaran()
    {
        $pendaftaran = Pendaftaran::with('berkas')->where('user_id', Auth::id())->first();
        return view('pendaftaran.form_pendaftaran', compact('pendaftaran'));
    }

    public function upload()
    {
        $pendaftaran = Pendaftaran::with('berkas')->where('user_id', Auth::id())->first();
        return view('berkas.upload_dokumen', compact('pendaftaran'));
    }

    public function pembayaran()
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
        return view('pembayaran.pembayaran_wisuda', compact('pendaftaran'));
    }

    public function updateKursi(Request $request)
    {
        $request->validate([
            'jumlah_kursi' => 'required|integer|min:0|max:5',
        ]);

        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->firstOrFail();
        $pendaftaran->update([
            'jumlah_kursi_tambahan' => $request->jumlah_kursi
        ]);

        return redirect()->back()->with('success', 'Jumlah kursi tambahan berhasil diperbarui.');
    }

    public function storePembayaran(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
            $pendaftaran->update([
                'bukti_pembayaran' => $path,
                'status_pembayaran' => 'menunggu_verifikasi'
            ]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu verifikasi.');
    }

    public function notifikasi()
    {
        return view('notifikasi.index');
    }

    public function editPendaftaran()
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
        return view('pendaftaran.form_pendaftaran', [
            'pendaftaran' => $pendaftaran,
            'is_editing' => true
        ]);
    }

    public function updatePendaftaran(Request $request)
    {
        $p = Pendaftaran::where('user_id', Auth::id())->firstOrFail();
        $p->update([
            'nama_mahasiswa' => $request->nama,
            'nim' => $request->nim,
            'program_studi' => $request->prodi,
            'judul_skripsi' => $request->judul_skripsi,
            'pembimbing_1' => $request->pembimbing_1,
            'pembimbing_2' => $request->pembimbing_2,
            'email_aktif' => $request->email,
        ]);
        return redirect()->route('pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui!');
    }
   
    public function pengumuman()
    {
        $announcements = Announcement::latest()->get();
        return view('pengumuman.info_pengumuman', compact('announcements'));    
    }

    public function eTicket()
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
        return view('ticket.e_ticket', compact('pendaftaran'));
    }

    public function kehadiran()
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();
        // Assuming there is a relation or we just fetch logs for this registration
        $riwayat = $pendaftaran ? \App\Models\Kehadiran::where('pendaftaran_id', $pendaftaran->id)->latest()->get() : collect([]);
        return view('kehadiran.index', compact('pendaftaran', 'riwayat'));
    }
}