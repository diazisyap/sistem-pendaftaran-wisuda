@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="text-center md:text-left">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Riwayat Kehadiran</h2>
        <p class="text-gray-500 font-medium">Informasi kehadiran Anda saat acara wisuda.</p>
    </div>

    @if(!$pendaftaran || !$pendaftaran->qr_token)
    <div class="bg-amber-50 rounded-[2.5rem] p-8 border border-amber-100 flex flex-col items-center justify-center text-center">
        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-4">
            <i class="fas fa-lock text-2xl"></i>
        </div>
        <h3 class="font-bold text-gray-800 text-lg">QR Code Belum Tersedia</h3>
        <p class="text-gray-500 max-w-md mt-2">QR Code untuk presensi akan muncul setelah pendaftaran Anda diverifikasi dan dijadwalkan.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- QR Code Card -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center text-center">
            <h4 class="font-black text-gray-800 mb-6">QR Code Presensi</h4>
            <div class="p-4 bg-white border-4 border-[#0b3c39] rounded-3xl mb-6 shadow-2xl shadow-[#0b3c39]/20">
                {!! QrCode::size(200)->generate($pendaftaran->qr_token) !!}
            </div>
            <p class="font-bold text-[#0b3c39] text-lg tracking-widest">{{ $pendaftaran->qr_token }}</p>
            <p class="text-xs text-gray-400 font-medium mt-2 max-w-xs">Tunjukkan QR Code ini kepada panitia saat memasuki lokasi wisuda.</p>
        </div>

        <!-- History Log -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
            <h4 class="font-black text-gray-800 mb-6">Log Aktivitas</h4>
            <div class="space-y-4">
                @forelse($riwayat as $log)
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Berhasil Presensi</p>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">{{ $log->waktu_hadir->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-12 h-12 bg-gray-50 text-gray-300 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-history"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-400">Belum ada data presensi.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
