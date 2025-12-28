@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header -->
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative">
        <div class="relative z-10 text-center md:text-left">
            <h2 class="text-2xl font-black text-gray-800 mb-2">Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h2>
            <p class="text-gray-500 font-medium">Lengkapi seluruh persyaratan untuk dapat mengikuti Wisuda periode ini.</p>
        </div>
        <div class="w-24 h-24 bg-emerald-50 rounded-3xl flex items-center justify-center relative z-10 shadow-inner">
             <i class="fas fa-user-graduate text-4xl text-[#0b3c39]"></i>
        </div>
        <!-- Decorative Background Circle -->
        <div class="absolute -right-8 -top-8 w-48 h-48 bg-emerald-50/50 rounded-full blur-3xl"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Status Pendaftaran -->
        <div class="group bg-[#0b3c39] p-8 rounded-[2rem] shadow-xl shadow-emerald-900/10 text-white transform transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between mb-6">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                    <i class="fas fa-id-card text-xl"></i>
                </div>
                @php
                    $status = $pendaftaran ? $pendaftaran->status : 'belum_daftar';
                    $progress = 0;
                    if($pendaftaran) {
                        $progress = 25;
                        if($pendaftaran->berkas) {
                            $filled_berkas = collect($pendaftaran->berkas->getAttributes())
                                ->only(['foto_formal', 'foto_bebas', 'surat_pernyataan', 'transkip_nilai', 'krs_terpenuhi'])
                                ->filter()
                                ->count();
                            $progress += ($filled_berkas / 5) * 50; // Max 75% for files
                        }
                        if($pendaftaran->status == 'terverifikasi') $progress = 100;
                    }
                @endphp
                <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-500/20 px-3 py-1 rounded-full">{{ str_replace('_', ' ', $status) }}</span>
            </div>
            <h3 class="text-lg font-bold mb-1">Status Pendaftaran</h3>
            <p class="text-white/60 text-sm mb-6 font-medium">Berkas identitas mahasiswa</p>
            
            <div class="space-y-2">
                <div class="flex justify-between items-end">
                    <span class="text-xs font-bold text-white/50">Progress</span>
                    <span class="text-sm font-black">{{ round($progress) }}%</span>
                </div>
                <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-400 rounded-full shadow-[0_0_10px_rgba(52,211,153,0.5)] transition-all duration-1000" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="group bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 transform transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between mb-6">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-wallet text-xl text-amber-600"></i>
                </div>
                @php
                    $isPaid = $pendaftaran && $pendaftaran->status == 'terverifikasi';
                    $isPendingPay = $pendaftaran && $pendaftaran->status == 'menunggu_pembayaran';
                @endphp
                <span class="text-[10px] font-black uppercase tracking-widest {{ $isPaid ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }} px-3 py-1 rounded-full">
                    {{ $isPaid ? 'Lunas' : ($isPendingPay ? 'Menunggu' : 'Belum Bayar') }}
                </span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Status Pembayaran</h3>
            <p class="text-gray-400 text-sm mb-6 font-medium">Verifikasi biaya wisuda</p>
            
            @if($isPaid)
            <div class="flex items-center text-emerald-600 font-black">
                <i class="fas fa-check-circle mr-2"></i>
                <span>SUDAH TERVERIFIKASI</span>
            </div>
            @else
            <div class="flex items-center text-amber-500 font-black">
                <i class="fas fa-clock mr-2"></i>
                <span>{{ $isPendingPay ? 'MENUNGGU VERIFIKASI' : 'BELUM ADA PEMBAYARAN' }}</span>
            </div>
            @endif
        </div>

        <!-- Pengumuman -->
        <div class="group bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 transform transition-all hover:-translate-y-1">
            <div class="flex items-center justify-between mb-6">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-bullhorn text-xl text-blue-600"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Info</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Pengumuman</h3>
            <p class="text-gray-400 text-sm mb-6 font-medium">Informasi terbaru wisuda</p>
            
            <a href="{{ route('pengumuman') }}" class="block w-full py-3 bg-gray-50 text-[#0b3c39] font-bold text-sm rounded-xl transition-all hover:bg-emerald-50 text-center">Lihat Semua</a>
        </div>

        @if($pendaftaran && $pendaftaran->status == 'terverifikasi')
        <!-- QR Code Acces (Improved) -->
        <div class="group bg-[#0b3c39] p-8 rounded-[2rem] shadow-xl shadow-emerald-900/10 text-white transform transition-all hover:-translate-y-1 md:col-span-3 lg:col-span-1">
            <div class="flex items-center justify-between mb-6">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                    <i class="fas fa-qrcode text-xl"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-500/20 px-3 py-1 rounded-full">E-Ticket Ready</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="p-2 bg-white rounded-2xl shadow-sm">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($pendaftaran->qr_token ?? $pendaftaran->nim) !!}
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-1">Pass Masuk</h3>
                    <p class="text-white/60 text-[10px] mb-4 uppercase tracking-widest">Scan di Gerbang Utama</p>
                    <a href="{{ route('e-ticket') }}" class="inline-flex items-center text-[#0b3c39] font-black text-[10px] uppercase tracking-widest gap-2 bg-amber-400 px-4 py-2 rounded-xl hover:bg-amber-500 transition-all">
                        E-Ticket Tamu <i class="fas fa-ticket-alt"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($pendaftaran && $pendaftaran->berkas)
    <!-- Document Status Section (New) -->
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative">
        <h3 class="text-xl font-black text-gray-800 mb-6">Status Verifikasi Berkas</h3>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @php
                $docs = [
                    'foto_formal' => 'Foto Formal',
                    'foto_bebas' => 'Foto Bebas',
                    'surat_pernyataan' => 'S. Pernyataan',
                    'transkip_nilai' => 'Transkrip',
                    'krs_terpenuhi' => 'Bukti KRS',
                ];
                $berkas = $pendaftaran->berkas;
            @endphp
            @foreach($docs as $key => $name)
            @php 
                $statusKey = 'status_' . $key;
                $status = $berkas->$statusKey ?? 'pending';
                $catatanKey = 'catatan_' . $key;
                $catatan = $berkas->$catatanKey;
            @endphp
            <div class="p-4 rounded-3xl border {{ $status == 'terverifikasi' ? 'bg-emerald-50 border-emerald-100' : ($status == 'revisi' ? 'bg-red-50 border-red-100 animate-pulse' : 'bg-gray-50 border-gray-100') }}">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">{{ $name }}</p>
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas {{ $status == 'terverifikasi' ? 'fa-check-circle text-emerald-500' : ($status == 'revisi' ? 'fa-exclamation-circle text-red-500' : 'fa-clock text-gray-400') }} text-sm"></i>
                    <span class="text-xs font-black uppercase tracking-wider {{ $status == 'terverifikasi' ? 'text-emerald-700' : ($status == 'revisi' ? 'text-red-700' : 'text-gray-500') }}">{{ $status }}</span>
                </div>
                @if($status == 'revisi' && $catatan)
                    <p class="text-[9px] font-bold text-red-600 leading-tight">Revisi: {{ $catatan }}</p>
                    <a href="{{ route('upload-berkas') }}" class="mt-2 inline-block px-3 py-1 bg-red-600 text-white text-[9px] font-black rounded-lg uppercase">Perbaiki</a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Quick Actions / Guidelines -->
    <div class="bg-amber-400 p-8 rounded-[2rem] shadow-lg shadow-amber-900/10 text-amber-950 flex flex-col md:flex-row items-center gap-8">
        <div class="flex-1">
            <h3 class="text-xl font-black mb-2 uppercase italic tracking-tighter">Informasi Penting!</h3>
            <p class="font-medium text-amber-900/80 leading-relaxed mb-6">Pastikan seluruh berkas yang diunggah berupa file PDF atau gambar (JPG/PNG) dengan ukuran maksimal 2MB per file.</p>
            <a href="{{ url('/syarat') }}" class="inline-flex items-center bg-amber-950 text-white px-6 py-3 rounded-2xl font-bold text-sm transition-all hover:scale-105">
                Baca Panduan <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>
        </div>
        <div class="hidden lg:block">
            <i class="fas fa-scroll-old text-[8rem] text-amber-900/10 transform -rotate-12 translate-y-4"></i>
        </div>
    </div>
</div>
@endsection
