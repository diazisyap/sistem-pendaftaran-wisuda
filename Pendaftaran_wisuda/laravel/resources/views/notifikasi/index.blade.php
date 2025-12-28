@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center space-x-3 mb-8">
        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
            <i class="fas fa-bell"></i>
        </div>
        <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Pusat Notifikasi</h2>
    </div>

    @php
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $berkas = $pendaftaran ? $pendaftaran->berkas : null;
        $notifikasi_items = [];

        // 1. Dokumen Belum Upload
        if ($pendaftaran && (!$berkas || !$berkas->foto_formal || !$berkas->foto_bebas || !$berkas->surat_pernyataan || !$berkas->transkip_nilai || !$berkas->krs_terpenuhi)) {
            $notifikasi_items[] = [
                'id' => 'doc_missing',
                'icon' => 'fa-file-upload',
                'color' => 'amber',
                'title' => 'Dokumen Belum Lengkap',
                'summary' => 'Beberapa dokumen persyaratan wajib belum diunggah.',
                'content' => 'Mohon segera melengkapi berkas persyaratan wisuda Anda agar dapat melanjutkan ke proses verifikasi. Dokumen yang diperlukan meliputi Foto Formal, Foto Bebas, Surat Pernyataan, Transkrip Nilai, dan Bukti Pembayaran.',
                'action_url' => route('upload-berkas'),
                'action_text' => 'Lengkapi Dokumen'
            ];
        }

        // 2. Jadwal Wisuda
        $sesi_wisuda = \App\Models\SesiWisuda::where('status_sesi', 'aktif')->first();
        if ($sesi_wisuda) {
            $notifikasi_items[] = [
                'id' => 'jadwal_wisuda',
                'icon' => 'fa-calendar-star',
                'color' => 'blue',
                'title' => 'Jadwal Wisuda Resmi',
                'summary' => 'Sesi wisuda telah dijadwalkan.',
                'content' => "Pelaksanaan wisuda sesi {$sesi_wisuda->nama_sesi} akan diselenggarakan pada tanggal " . \Carbon\Carbon::parse($sesi_wisuda->tanggal)->format('d F Y') . " dipusatkan di {$sesi_wisuda->lokasi}. Mohon hadir tepat waktu.",
                'action_url' => route('pengumuman'),
                'action_text' => 'Lihat Detail Acara'
            ];
            
            // 3. Jadwal Ambil Ijazah (Mock Logic based on Wisuda Date)
            $tgl_wisuda = \Carbon\Carbon::parse($sesi_wisuda->tanggal);
            $tgl_ijazah = $tgl_wisuda->copy()->addDays(7);
            
            $notifikasi_items[] = [
                'id' => 'jadwal_ijazah',
                'icon' => 'fa-scroll',
                'color' => 'emerald',
                'title' => 'Jadwal Pengambilan Ijazah',
                'summary' => 'Informasi pengambilan ijazah dan transkrip.',
                'content' => "Pengambilan Ijazah dan Transkrip Nilai dapat dilakukan mulai tanggal " . $tgl_ijazah->format('d F Y') . " di Bagian Akademik Kampus Pusat. Syarat pengambilan: Membawa Kartu Tanda Mahasiswa (KTM) dan Bukti Bebas Pustaka.",
                'action_url' => null,
                'action_text' => null
            ];

            // 4. Jadwal Gladi Resik (H-2 Wisuda)
            $tgl_gladi = $tgl_wisuda->copy()->subDays(2);
            $notifikasi_items[] = [
                'id' => 'jadwal_gladi',
                'icon' => 'fa-microphone-alt',
                'color' => 'purple',
                'title' => "Jadwal Gladi Resik - " . $tgl_gladi->translatedFormat('l, d F Y'),
                'summary' => 'Wajib hadir untuk persiapan wisuda.',
                'content' => "Gladi Resik akan dilaksanakan pada hari " . $tgl_gladi->translatedFormat('l, d F Y') . " pukul 08:00 WIB di {$sesi_wisuda->lokasi}. Mohon mahasiswa hadir mengenakan pakaian rapi dan sopan (kemeja putih, celana/rok hitam).",
                'action_url' => null,
                'action_text' => null
            ];
        } else {
             $notifikasi_items[] = [
                'id' => 'jadwal_empty',
                'icon' => 'fa-calendar-times',
                'color' => 'gray',
                'title' => 'Jadwal Wisuda',
                'summary' => 'Belum ada jadwal aktif.',
                'content' => 'Saat ini belum ada jadwal wisuda yang dibuka atau aktif. Silakan cek kembali secara berkala.',
                'action_url' => null,
                'action_text' => null
            ];
        }

        // 4. Status Pembayaran / Verifikasi
        if ($pendaftaran) {
             // Status Verifikasi Berkas
            if ($pendaftaran->status_pendaftaran == 'verifikasi_berkas') {
                 $notifikasi_items[] = [
                    'id' => 'status_verif',
                    'icon' => 'fa-spinner',
                    'color' => 'indigo',
                    'title' => 'Status Verifikasi Berkas',
                    'summary' => 'Berkas sedang diperiksa admin.',
                    'content' => 'Terima kasih telah mengunggah berkas. Saat ini tim admin kami sedang melakukan verifikasi kelengkapan dan keabsahan dokumen Anda. Proses ini biasanya memakan waktu 1-2 hari kerja.',
                    'action_url' => route('dashboard'),
                    'action_text' => 'Cek Dashboard'
                ];
            } elseif ($pendaftaran->status_pendaftaran == 'revisi_berkas') {
                 $notifikasi_items[] = [
                    'id' => 'status_revisi',
                    'icon' => 'fa-exclamation-triangle',
                    'color' => 'red',
                    'title' => 'Dokumen Gagal Di Upload',
                    'summary' => 'Terdapat kesalahan pada dokumen (file terlalu besar/format salah).',
                    'content' => 'Admin telah memeriksa berkas Anda dan menemukan ketidaksesuaian atau file yang korup. Mohon segera periksa detail revisi dan unggah ulang dokumen yang diminta agar proses pendaftaran dapat dilanjutkan.',
                    'action_url' => route('upload-berkas'),
                    'action_text' => 'Perbaiki Sekarang'
                ];
            }

            // Status Pembayaran
            if ($pendaftaran->status_pembayaran == 'menunggu_verifikasi') {
                $notifikasi_items[] = [
                    'id' => 'pay_verif',
                    'icon' => 'fa-receipt',
                    'color' => 'blue',
                    'title' => 'Verifikasi Pembayaran',
                    'summary' => 'Bukti pembayaran sedang dicek.',
                    'content' => 'Bukti pembayaran Anda telah kami terima. Admin Keuangan sedang memvalidasi transaksi tersebut. Mohon menunggu konfirmasi selanjutnya.',
                    'action_url' => route('pembayaran'),
                    'action_text' => 'Lihat Tagihan'
                ];
            } elseif ($pendaftaran->status_pembayaran == 'lunas') {
                 $notifikasi_items[] = [
                    'id' => 'pay_success',
                    'icon' => 'fa-check-circle',
                    'color' => 'green',
                    'title' => 'Pembayaran Terverifikasi',
                    'summary' => 'Pembayaran Anda telah terverifikasi.',
                    'content' => 'Selamat, pembayaran wisuda Anda telah lunas. Anda kini dapat mencetak kartu e-Ticket dan melanjutkan ke tahap persiapan wisuda berikutnya.',
                    'action_url' => route('e-ticket'),
                    'action_text' => 'Lihat E-Ticket'
                ];
            } elseif ($pendaftaran->status_pembayaran == 'ditolak') {
                 $notifikasi_items[] = [
                    'id' => 'pay_failed',
                    'icon' => 'fa-times-circle',
                    'color' => 'red',
                    'title' => 'Pembayaran Ditolak',
                    'summary' => 'Bukti transfer tidak valid.',
                    'content' => 'Maaf, bukti pembayaran yang Anda unggah ditolak oleh admin. Hal ini mungkin karena nominal tidak sesuai atau gambar tidak jelas. Silakan unggah bukti pembayaran yang valid.',
                    'action_url' => route('pembayaran'),
                    'action_text' => 'Unggah Ulang'
                ];
            }
        }
    @endphp

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        @foreach($notifikasi_items as $index => $item)
        <div x-data="{ expanded: false }" class="border-b border-gray-100 last:border-0">
            <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-6 hover:bg-gray-50 transition-all text-left group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-{{ $item['color'] }}-100 flex items-center justify-center text-{{ $item['color'] }}-600 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas {{ $item['icon'] }} text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-gray-800 mb-1 group-hover:text-[#0b3c39] transition-colors">{{ $item['title'] }}</h4>
                        <p class="text-xs text-gray-500 font-medium">{{ $item['summary'] }}</p>
                    </div>
                </div>
                <div class="h-8 w-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-[#0b3c39] group-hover:text-white transition-all">
                    <i class="fas fa-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': expanded }"></i>
                </div>
            </button>
            <div x-show="expanded" x-collapse style="display: none;">
                <div class="px-6 pb-6 pl-[5.5rem] pr-10">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $item['content'] }}</p>
                        @if($item['action_url'])
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ $item['action_url'] }}" class="inline-flex items-center space-x-2 text-xs font-black text-[#0b3c39] hover:underline uppercase tracking-wide">
                                    <span>{{ $item['action_text'] }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @if(empty($notifikasi_items))
            <div class="p-10 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-bell-slash text-2xl"></i>
                </div>
                <p class="text-gray-500 font-medium">Belum ada notifikasi baru untuk Anda.</p>
            </div>
        @endif
    </div>
</div>

<!-- Alpine.js for Accordion Logic -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection