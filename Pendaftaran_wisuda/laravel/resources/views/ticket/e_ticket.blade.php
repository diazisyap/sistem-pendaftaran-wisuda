@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-12">
    <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 relative">
        <!-- Ticket Top Seal -->
        <div class="h-4 bg-[#0b3c39] w-full"></div>
        
        <div class="p-10 text-center">
            <div class="mb-8">
                <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center mx-auto mb-4 text-[#0b3c39]">
                    <i class="fas fa-graduation-cap text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">E-TICKET TAMU</h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-1">Wisuda Periode Agustus 2025</p>
            </div>

            <!-- QR Code Section -->
            <div class="bg-gray-50 p-6 rounded-[2.5rem] mb-10 border-2 border-dashed border-gray-200 relative">
                <div class="bg-white p-4 rounded-3xl shadow-inner inline-block">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(($pendaftaran->qr_token ?? $pendaftaran->nim) . '-GUEST') !!}
                </div>
                <!-- Cutout Circles -->
                <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-[#f8fafc] rounded-full"></div>
                <div class="absolute -right-4 top-1/2 -translate-y-1/2 w-8 h-8 bg-[#f8fafc] rounded-full"></div>
            </div>

            <!-- Details -->
            <div class="space-y-6 text-left">
                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Mahasiswa</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->nama_mahasiswa }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">NIM</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->nim }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sektor/Blok</p>
                        <p class="font-bold text-[#0b3c39]">{{ $pendaftaran->sektor_kursi ?? 'SEKTOR A-1' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kapasitas</p>
                        <p class="font-bold text-gray-800">{{ $pendaftaran->kuota_tamu ?? 2 }} Orang Tua</p>
                    </div>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-10 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                <p class="text-[10px] font-bold text-amber-800 leading-tight">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tunjukkan QR Code ini kepada petugas di pintu masuk auditorium. Berlaku untuk {{ $pendaftaran->kuota_tamu ?? 2 }} orang tamu pendamping.
                </p>
            </div>

            <button onclick="window.print()" class="mt-10 w-full py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all flex items-center justify-center gap-3">
                <i class="fas fa-print"></i> Cetak E-Ticket
            </button>
        </div>
        
        <!-- Decorative Bottom -->
        <div class="h-2 bg-gray-50 repeating-linear-gradient flex">
            @for($i=0; $i<20; $i++)
            <div class="flex-1 h-full border-r border-white"></div>
            @endfor
        </div>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    .max-w-md, .max-w-md * { visibility: visible; }
    .max-w-md { position: absolute; left: 0; top: 0; width: 100%; max-width: none; }
    button { display: none; }
}
</style>
@endsection
