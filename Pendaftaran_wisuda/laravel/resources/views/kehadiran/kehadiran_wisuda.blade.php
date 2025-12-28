@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight flex items-center">
                <i class="fas fa-calendar-check text-[#0b3c39] mr-4"></i> Kehadiran Wisuda
            </h2>
            <p class="text-gray-500 font-medium ml-12">Log presensi mahasiswa dan tamu undangan di lokasi wisuda.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Kehadiran Mahasiswa -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden transition-all hover:shadow-xl hover:shadow-emerald-900/5">
            <div class="flex items-center justify-between mb-8">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-[#0b3c39] shadow-inner">
                    <i class="fas fa-user-graduate text-xl"></i>
                </div>
                <span class="px-4 py-1.5 bg-red-100 text-red-600 rounded-full text-[10px] font-black tracking-widest uppercase">Belum Hadir</span>
            </div>
            
            <h3 class="text-xl font-black text-gray-800 mb-6 uppercase tracking-tight">Presensi Mahasiswa</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Waktu Scan QR</span>
                    <span class="text-sm font-bold text-gray-700">27 Nov 2025 - 07:00</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Status Barcode</span>
                    <span class="text-sm font-bold text-gray-700">Ready to Scan</span>
                </div>
            </div>

            <div class="mt-8">
                <button class="w-full py-4 bg-gray-100 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest cursor-not-allowed">
                    <i class="fas fa-qrcode mr-2"></i> Munculkan QR Code
                </button>
            </div>
        </div>

        <!-- Kehadiran Wali -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden transition-all hover:shadow-xl hover:shadow-emerald-900/5">
            <div class="flex items-center justify-between mb-8">
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 shadow-inner">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <span class="px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black tracking-widest uppercase">Menunggu Tamu</span>
            </div>
            
            <h3 class="text-xl font-black text-gray-800 mb-6 uppercase tracking-tight">Presensi Wali / Tamu</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Waktu Masuk</span>
                    <span class="text-sm font-bold text-gray-700">-</span>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Kuota Kursi Tamu</span>
                    <span class="text-sm font-bold text-amber-600">2 Kursi (Belum Terpakai)</span>
                </div>
            </div>

            <div class="mt-8">
                <button class="w-full py-4 bg-amber-400 text-amber-950 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-amber-100 hover:bg-amber-500 transition-all">
                    <i class="fas fa-ticket-alt mr-2"></i> E-Ticket Tamu
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
