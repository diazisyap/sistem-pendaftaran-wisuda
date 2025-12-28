<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Announcement;
use App\Models\SesiWisuda;
use App\Models\Kehadiran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrCodeMail;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => Pendaftaran::count(),
            'menunggu_verifikasi' => Pendaftaran::where('status', 'menunggu')->count(),
            'terverifikasi' => Pendaftaran::where('status', 'terverifikasi')->count(),
            'ditolak_revisi' => Pendaftaran::where('status', 'ditolak')->count(),
        ];
        $recent_pendaftar = Pendaftaran::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_pendaftar'));
    }

    public function pendaftaran(Request $request)
    {
        $search = $request->input('search');
        $all_pendaftaran = Pendaftaran::when($search, function($query, $search) {
                return $query->where('nama_mahasiswa', 'like', "%$search%")
                             ->orWhere('nim', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);
        return view('admin.pendaftaran', compact('all_pendaftaran'));
    }

    public function verifikasiBerkas(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = Pendaftaran::when($search, function($query, $search) {
                return $query->where('nama_mahasiswa', 'like', "%$search%")
                             ->orWhere('nim', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);
        return view('admin.verifikasi_berkas_index', compact('pendaftaran'));
    }

    public function verifikasiBerkasDetail($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.verifikasi_berkas', compact('pendaftaran'));
    }

    public function approveBerkas($id)
    {
        $p = Pendaftaran::findOrFail($id);
        $p->update(['status' => 'terverifikasi']);
        return redirect()->route('admin.verifikasi.berkas')->with('success', 'Berkas mahasiswa ' . $p->nama_mahasiswa . ' berhasil disetujui!');
    }

    public function rejectBerkas($id)
    {
        Pendaftaran::findOrFail($id)->update(['status' => 'ditolak']);
        return redirect()->route('admin.verifikasi.berkas')->with('success', 'Status pendaftaran diupdate menjadi ditolak/revisi.');
    }

    public function updateDocStatus(Request $request, $id, $doc)
    {
        $p = Pendaftaran::findOrFail($id);
        $berkas = $p->berkas;
        
        if ($berkas) {
            $statusKey = 'status_' . $doc;
            $catatanKey = 'catatan_' . $doc;
            
            $berkas->update([
                $statusKey => $request->status,
                $catatanKey => $request->catatan,
            ]);
        }
        
        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    public function pembayaran(Request $request)
    {
        $search = $request->input('search');
        $pendaftaran = Pendaftaran::when($search, function($query, $search) {
                return $query->where('nama_mahasiswa', 'like', "%$search%")
                             ->orWhere('nim', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);
        return view('admin.pembayaran_index', compact('pendaftaran'));
    }

    public function pembayaranDetail($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pembayaran', compact('pendaftaran'));
    }

    public function approvePembayaran($id)
    {
        $p = Pendaftaran::findOrFail($id);
        $p->update(['status' => 'terverifikasi']); // In this simple flow, payment approve means final success
        return redirect()->route('admin.pembayaran')->with('success', 'Pembayaran mahasiswa ' . $p->nama_mahasiswa . ' berhasil divalidasi!');
    }

    public function rejectPembayaran($id)
    {
        $p = Pendaftaran::findOrFail($id);
        $p->update(['status' => 'menunggu_pembayaran']); // Let them try again
        return redirect()->route('admin.pembayaran')->with('success', 'Pembayaran mahasiswa ' . $p->nama_mahasiswa . ' ditolak.');
    }

    public function jadwalWisuda()
    {
        $jadwal = SesiWisuda::latest()->get();
        return view('admin.jadwal_wisuda', compact('jadwal'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'nama_sesi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kuota' => 'required|integer',
        ]);
        SesiWisuda::create($request->all());
        return back()->with('success', 'Jadwal wisuda baru berhasil ditambahkan!');
    }

    public function updateJadwal(Request $request, $id)
    {
        $request->validate([
            'nama_sesi' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'lokasi' => 'required',
            'kuota' => 'required|integer',
        ]);
        SesiWisuda::findOrFail($id)->update($request->all());
        return back()->with('success', 'Jadwal wisuda berhasil diperbarui!');
    }

    public function deleteJadwal($id)
    {
        SesiWisuda::findOrFail($id)->delete();
        return back()->with('success', 'Jadwal wisuda berhasil dihapus!');
    }

    public function manajemenMahasiswa(Request $request)
    {
        $search = $request->input('search');
        $students = User::where('role', 'student')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%$search%")
                             ->orWhere('email', 'like', "%$search%")
                             ->orWhereHas('pendaftaran', function($q) use ($search) {
                                 $q->where('nim', 'like', "%$search%");
                             });
            })
            ->with('pendaftaran')
            ->latest()
            ->paginate(10);
        return view('admin.manajemen_mahasiswa', compact('students'));
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
        User::findOrFail($id)->update($request->only('name', 'email'));
        return back()->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function deleteMahasiswa($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akun mahasiswa berhasil dihapus!');
    }

    public function pengumuman()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.pengumuman', compact('announcements'));
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);

        Announcement::create($request->all());

        return back()->with('success', 'Pengumuman berhasil diterbitkan!');
    }

    public function updatePengumuman(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);

        Announcement::findOrFail($id)->update($request->all());

        return back()->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function deletePengumuman($id)
    {
        Announcement::findOrFail($id)->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function dataFinal(Request $request)
    {
        $search = $request->input('search');
        $final_students = Pendaftaran::where('status', 'terverifikasi')
            ->when($search, function($query, $search) {
                return $query->where('nama_mahasiswa', 'like', "%$search%")
                             ->orWhere('nim', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);
        return view('admin.data_final', compact('final_students'));
    }

    public function exportFinal()
    {
        $students = Pendaftaran::where('status', 'terverifikasi')->latest()->get();
        return $this->exportCsv($students, "Data_Final_Wisuda_");
    }

    public function exportAllPendaftaran()
    {
        $students = Pendaftaran::latest()->get();
        return $this->exportCsv($students, "Semua_Pendaftar_Wisuda_");
    }

    public function exportLaporanKeuangan()
    {
        $filename = "Laporan_Keuangan_Wisuda_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        fputcsv($handle, ['Laporan Keuangan Wisuda']);
        fputcsv($handle, ['Tanggal Generate', date('d M Y H:i')]);
        fputcsv($handle, []);
        
        $terverifikasi = Pendaftaran::where('status', 'terverifikasi')->count();
        $menunggu = Pendaftaran::where('status', 'menunggu_pembayaran')->count();
        
        fputcsv($handle, ['Kategori', 'Jumlah Mahasiswa', 'Nominal Satuan', 'Total']);
        fputcsv($handle, ['Pembayaran Terverifikasi (Lunas)', $terverifikasi, 'Rp 500.000', 'Rp ' . number_format($terverifikasi * 500000, 0, ',', '.')]);
        fputcsv($handle, ['Menunggu Pembayaran (Potensi)', $menunggu, 'Rp 500.000', 'Rp ' . number_format($menunggu * 500000, 0, ',', '.')]);
        fputcsv($handle, []);
        fputcsv($handle, ['Total Pendapatan Riil', '', '', 'Rp ' . number_format($terverifikasi * 500000, 0, ',', '.')]);
        
        fclose($handle);
        exit;
    }

    private function exportCsv($data, $prefix)
    {
        $filename = $prefix . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        fputcsv($handle, ['NIM', 'Nama Mahasiswa', 'Program Studi', 'Judul Skripsi', 'Email', 'Pembimbing 1', 'Pembimbing 2', 'Status']);
        
        foreach($data as $student) {
            fputcsv($handle, [
                $student->nim,
                $student->nama_mahasiswa,
                $student->program_studi,
                $student->judul_skripsi,
                $student->email_aktif,
                $student->pembimbing_1,
                $student->pembimbing_2,
                $student->status
            ]);
        }
        
        fclose($handle);
        exit;
    }

    public function rejectPendaftaran($id)
    {
        Pendaftaran::findOrFail($id)->update(['status' => 'ditolak']);
        return back()->with('success', 'Status pendaftaran berhasil diubah menjadi Ditolak.');
    }

    public function generateQr()
    {
        $students = Pendaftaran::where('status', 'terverifikasi')->latest()->get();
        return view('admin.generate_qr', compact('students'));
    }

    public function generateQrSingle($id)
    {
        $p = Pendaftaran::findOrFail($id);
        if (!$p->qr_token) {
            $p->update([
                'qr_token' => 'WDS-' . $p->nim . '-' . Str::upper(Str::random(6)),
                'qr_generated_at' => now(),
            ]);
            
            try {
                if ($p->email_aktif) {
                    Mail::to($p->email_aktif)->send(new QrCodeMail($p));
                }
            } catch (\Exception $e) {
                // Log error but assume success for user
                \Log::error('Gagal mengirim email QR ke ' . $p->email_aktif . ': ' . $e->getMessage());
            }
        }
        return back()->with('success', 'QR Code untuk ' . $p->nama_mahasiswa . ' berhasil dibuat (Email akan dikirim jika dikonfigurasi).');
    }

    public function generateQrBulk()
    {
        $students = Pendaftaran::where('status', 'terverifikasi')
            ->whereNull('qr_token')
            ->get();
            
        foreach ($students as $p) {
            $p->update([
                'qr_token' => 'WDS-' . $p->nim . '-' . Str::upper(Str::random(6)),
                'qr_generated_at' => now(),
            ]);

            try {
                if ($p->email_aktif) {
                    Mail::to($p->email_aktif)->send(new QrCodeMail($p));
                }
            } catch (\Exception $e) {
               \Log::error('Bulk QR Email Error: ' . $e->getMessage());
            }
        }
        
        return back()->with('success', count($students) . ' QR Code berhasil di-generate secara massal!');
    }

    public function scanner()
    {
        return view('admin.scanner');
    }

    public function storeScan(Request $request)
    {
        $qr_token = $request->qr_token;
        $p = Pendaftaran::where('qr_token', $qr_token)->first();

        if ($p) {
            // Check if already scanned
            $exists = Kehadiran::where('pendaftaran_id', $p->id)->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'Mahasiswa ' . $p->nama_mahasiswa . ' sudah melakukan presensi.']);
            }

            Kehadiran::create([
                'pendaftaran_id' => $p->id,
                'waktu_hadir' => now(),
                'keterangan' => 'Hadir via Scanner'
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Presensi Berhasil!',
                'nama' => $p->nama_mahasiswa,
                'nim' => $p->nim
            ]);
        }

        return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau tidak ditemukan.']);
    }

    public function laporan()
    {
        return view('admin.laporan');
    }
}
