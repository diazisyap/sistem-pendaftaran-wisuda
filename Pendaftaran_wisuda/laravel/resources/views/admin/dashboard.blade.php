@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Pendaftar</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['total_pendaftar']) }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center">
                <i class="fas fa-file-check text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Terverifikasi</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['terverifikasi']) }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center">
                <i class="fas fa-clock text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Menunggu Verifikasi</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['menunggu_verifikasi']) }}</h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Ditolak / Revisi</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($stats['ditolak_revisi']) }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Registrants -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-lg">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.pendaftaran') }}" class="text-[#0b3c39] text-sm font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Prodi</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recent_pendaftar as $p)
                        <tr>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $p->nim }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $p->nama_mahasiswa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $p->program_studi }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase border 
                                    {{ $p->status == 'terverifikasi' ? 'bg-green-50 text-green-600 border-green-100' : ($p->status == 'ditolak' ? 'bg-red-50 text-red-600 border-red-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100') }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.verifikasi.berkas.detail', $p->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#0b3c39] hover:text-white transition-all inline-flex"><i class="fas fa-eye text-[10px]"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest italic">Belum ada pendaftar terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="space-y-8">
            <!-- Latest News (replacing hardcoded notifications) -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-black text-gray-800 uppercase text-xs tracking-[0.2em]">Info Terkini</h3>
                    <i class="fas fa-bolt text-amber-500 text-sm"></i>
                </div>
                <div class="space-y-6">
                    @php
                        $ann = \App\Models\Announcement::latest()->take(3)->get();
                    @endphp
                    @forelse($ann as $a)
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 rounded-full bg-[#0b3c39] mt-2"></div>
                        <div>
                            <p class="text-xs font-black text-gray-800 leading-relaxed">{{ $a->title }}</p>
                            <p class="text-[10px] text-gray-400 font-bold mt-1">{{ $a->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-[10px] text-gray-400 font-bold italic uppercase tracking-widest text-center py-4">Tidak ada pengumuman baru</p>
                    @endforelse
                </div>
            </div>

            <!-- Graduation Schedule -->
            @php $next_sesi = \App\Models\SesiWisuda::where('status_sesi', 'aktif')->orderBy('tanggal')->first(); @endphp
            <div class="bg-[#0b3c39] p-10 rounded-[2.5rem] shadow-2xl shadow-emerald-950/20 text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
                <h3 class="font-black text-xs uppercase tracking-[0.2em] mb-8 opacity-60">Agenda Terdekat</h3>
                @if($next_sesi)
                <div class="space-y-6 relative z-10">
                    <p class="text-2xl font-black leading-tight italic">{{ $next_sesi->nama_sesi }}</p>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 text-emerald-100/80">
                            <i class="fas fa-calendar-star text-sm"></i>
                            <span class="text-xs font-bold">{{ \Carbon\Carbon::parse($next_sesi->tanggal)->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-4 text-emerald-100/80">
                            <i class="fas fa-map-marker-alt text-sm"></i>
                            <span class="text-xs font-bold">{{ $next_sesi->lokasi }}</span>
                        </div>
                    </div>
                </div>
                @else
                <p class="text-xs font-black text-emerald-100/50 uppercase tracking-widest italic">Belum ada jadwal aktif</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
