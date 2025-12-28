@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-[#0b3c39] rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden shadow-2xl shadow-emerald-900/20">
        <!-- Decorative Background -->
        <i class="fas fa-wallet absolute -right-6 -bottom-6 text-9xl text-white/5 rotate-12"></i>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mr-16 -mt-16"></div>
        
        <div class="relative z-10">
            <a href="{{ route('admin.pembayaran') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white rounded-xl text-xs font-bold hover:bg-white/20 transition-all backdrop-blur-md mb-6 border border-white/10">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            
            <div class="md:flex md:items-end md:justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-block py-1 px-3 rounded-lg bg-emerald-400/20 text-emerald-300 text-[10px] font-black tracking-widest uppercase mb-2 border border-emerald-400/20">Verifikasi Pembayaran</span>
                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">{{ $pendaftaran->nama_mahasiswa }}</h2>
                    <p class="text-emerald-100/70 font-medium text-sm">NIM: {{ $pendaftaran->nim }} • Program Studi: {{ $pendaftaran->program_studi }}</p>
                </div>
                
                <div class="mt-6 md:mt-0">
                    <div class="flex items-center gap-3">
                         <div class="px-4 py-2 bg-white/10 rounded-xl border border-white/10 backdrop-blur-md text-center">
                            <span class="block text-[10px] text-emerald-200 uppercase tracking-widest font-bold">Total Pembayaran</span>
                            @php
                                // Calculate Total
                                $adminFee = 500000;
                                $togaFee = 250000;
                                $seatPrice = 150000;
                                $extraSeats = $pendaftaran->jumlah_kursi_tambahan ?? 0;
                                $extraCost = $extraSeats * $seatPrice;
                                $total = $adminFee + $togaFee + $extraCost;
                            @endphp
                            <span class="block text-white font-black text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Details Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 h-fit"> 
            <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center">
                <i class="fas fa-receipt text-[#0b3c39] mr-3"></i> Rincian Tagihan
            </h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Biaya Pendaftaran</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">Administrasi Wisuda</p>
                    </div>
                    <span class="font-black text-gray-700">Rp 500.000</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                    <div>
                         <p class="font-bold text-gray-800 text-sm">Toga & Kelengkapan</p>
                         <p class="text-[10px] text-gray-400 uppercase tracking-wide">Atribut Wisuda</p>
                    </div>
                    <span class="font-black text-gray-700">Rp 250.000</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                    <div>
                         <p class="font-bold text-gray-800 text-sm">Kursi Tambahan <span class="text-xs bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full ml-1 font-black">×{{ $extraSeats }}</span></p>
                         <p class="text-[10px] text-gray-400 uppercase tracking-wide">Tamu Undangan</p>
                    </div>
                    <span class="font-black text-gray-700">Rp {{ number_format($extraCost, 0, ',', '.') }}</span>
                </div>
                
                <div class="border-t border-dashed border-gray-200 my-4"></div>
                
                <div class="flex justify-between items-center px-4">
                    <span class="font-black text-gray-400 text-xs uppercase tracking-widest">Total Tagihan</span>
                    <span class="font-black text-2xl text-[#0b3c39]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Proof & Action Card -->
        <div class="space-y-8">
             <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100"> 
                 <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-image text-[#0b3c39] mr-3"></i> Bukti Pembayaran
                </h3>
                
                @if($pendaftaran->bukti_pembayaran)
                <div onclick="document.getElementById('modal-bukti').classList.remove('hidden')" class="relative group cursor-pointer overflow-hidden rounded-[2rem] border-4 border-gray-50 aspect-video flex items-center justify-center bg-gray-100">
                    <img src="{{ \Storage::url($pendaftaran->bukti_pembayaran) }}" class="w-full h-full object-contain">
                    <div class="absolute inset-0 bg-[#0b3c39]/0 group-hover:bg-[#0b3c39]/20 transition-all flex items-center justify-center">
                        <span class="bg-white text-[#0b3c39] px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0">
                            <i class="fas fa-search-plus mr-2"></i>Perbesar
                        </span>
                    </div>
                </div>
                <!-- Action Buttons -->
                @if($pendaftaran->status != 'terverifikasi')
                <div class="mt-8 flex gap-3">
                     <form action="{{ route('admin.pembayaran.reject', $pendaftaran->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-red-50 text-red-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-100 transition-all">
                            Tolak
                        </button>
                    </form>
                    <form action="{{ route('admin.pembayaran.approve', $pendaftaran->id) }}" method="POST" class="flex-[2]">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2"></i> Validasi Lunas
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-8 space-y-4">
                    <div class="w-full py-4 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-xs uppercase tracking-widest flex items-center justify-center border border-emerald-100">
                        <i class="fas fa-check-double mr-2"></i> Pembayaran Telah Diverifikasi
                    </div>
                    
                    <!-- Edit / Reset Button -->
                    <form action="{{ route('admin.pembayaran.reject', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin membatalkan status lunas ini? Status akan kembali menjadi Menunggu Pembayaran.')" class="w-full py-3 text-gray-400 rounded-xl font-bold text-xs hover:text-red-500 hover:bg-red-50 transition-all flex items-center justify-center">
                            <i class="fas fa-undo-alt mr-2"></i> Batalkan / Edit Status
                        </button>
                    </form>
                </div>
                @endif
                
                @else
                <div class="relative overflow-hidden rounded-[2rem] border-4 border-gray-50 aspect-video flex items-center justify-center bg-gray-100">
                    <div class="text-center">
                        <i class="fas fa-image text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-400 font-bold">Belum ada bukti upload</p>
                    </div>
                </div>
                @endif
             </div>
        </div>
    </div>
</div>

<!-- Modal Bukti -->
@if($pendaftaran->bukti_pembayaran)
<div id="modal-bukti" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" onclick="this.classList.add('hidden')">
    <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
        <button onclick="document.getElementById('modal-bukti').classList.add('hidden')" class="absolute -top-4 -right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-all shadow-lg z-10">
            <i class="fas fa-times text-xl"></i>
        </button>
        <img src="{{ \Storage::url($pendaftaran->bukti_pembayaran) }}" class="w-full h-auto rounded-2xl shadow-2xl">
    </div>
</div>
@endif
@endsection
