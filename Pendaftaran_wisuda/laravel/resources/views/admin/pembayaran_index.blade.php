@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-[#0b3c39] rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden shadow-2xl shadow-emerald-900/20">
        <!-- Decorative Background -->
        <i class="fas fa-wallet absolute -right-6 -bottom-6 text-9xl text-white/5 rotate-12"></i>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mr-16 -mt-16"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-xl">
                <span class="inline-block py-1 px-3 rounded-lg bg-emerald-400/20 text-emerald-300 text-[10px] font-black tracking-widest uppercase mb-4 border border-emerald-400/20">Admin Dashboard</span>
                <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">Verifikasi Pembayaran</h2>
                <p class="text-emerald-100/70 font-medium text-sm leading-relaxed">Kelola dan validasi bukti transfer pembayaran wisuda dari mahasiswa. Pastikan nominal dan data sesuai sebelum menyetujui.</p>
            </div>

            <!-- Search Bar integrated into header -->
            <div class="w-full md:w-auto bg-white/10 backdrop-blur-md border border-white/20 p-2 rounded-2xl flex items-center">
                <form action="{{ route('admin.pembayaran') }}" method="GET" class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white mr-3">
                        <i class="fas fa-search text-xs"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mahasiswa, NIM..." class="bg-transparent border-none focus:ring-0 text-sm font-bold text-white placeholder:text-white/40 w-full md:w-64">
                </form>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Mahasiswa</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Prodi</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Nominal</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pendaftaran as $p)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 font-bold text-xs ring-4 ring-white">
                                    {{ strtoupper(substr($p->nama_mahasiswa, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $p->nama_mahasiswa }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium">{{ $p->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-gray-600">{{ $p->program_studi }}</td>
                        <td class="px-6 py-4">
                            @php
                                $totalTagihan = 750000 + ($p->jumlah_kursi_tambahan * 150000);
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500 font-medium">{{ $p->updated_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.pembayaran.detail', $p->id) }}" class="w-8 h-8 bg-white border border-gray-200 text-gray-600 rounded-lg flex items-center justify-center hover:bg-[#0b3c39] hover:text-white hover:border-[#0b3c39] transition-all shadow-sm" title="Lihat Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                @if($p->status == 'terverifikasi')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-black uppercase tracking-widest border border-emerald-200">
                                    <i class="fas fa-check-circle"></i> Lunas
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                                <i class="fas fa-wallet text-2xl"></i>
                            </div>
                            <p class="text-gray-400 font-bold text-xs">Tidak ada data pembayaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-50 flex items-center justify-between">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Halaman {{ $pendaftaran->currentPage() }} dari {{ $pendaftaran->lastPage() }}</span>
            <div class="flex gap-2">
                @if($pendaftaran->onFirstPage())
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Mundur</span>
                @else
                    <a href="{{ $pendaftaran->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Mundur</a>
                @endif

                @if($pendaftaran->hasMorePages())
                    <a href="{{ $pendaftaran->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Maju</a>
                @else
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Maju</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
