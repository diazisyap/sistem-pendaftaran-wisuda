@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 text-lg">Data Seluruh Pendaftar Wisuda</h3>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.pendaftaran') }}" method="GET" class="flex items-center bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:border-[#0b3c39]/30 transition-all">
                    <i class="fas fa-search text-gray-400 mr-2 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="bg-transparent border-none focus:ring-0 text-xs font-bold w-40 placeholder:text-gray-300">
                </form>
                <a href="{{ route('admin.export.all') }}" class="px-4 py-2 bg-[#0b3c39] text-white rounded-xl text-xs font-black shadow-md hover:bg-emerald-900 transition-all uppercase tracking-widest flex items-center">
                    <i class="fas fa-file-export mr-2"></i> Export
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Prodi</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status Berkas</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($all_pendaftaran as $p)
                    <tr>
                        <td class="px-6 py-4 text-sm font-bold text-gray-800">{{ $p->nim }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">{{ $p->nama_mahasiswa }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $p->program_studi }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest 
                                {{ $p->status == 'terverifikasi' ? 'bg-green-50 text-green-600 border border-green-100' : ($p->status == 'ditolak' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-amber-50 text-amber-600 border border-amber-100') }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.verifikasi.berkas.detail', $p->id) }}" class="p-2 text-[#0b3c39] hover:bg-emerald-50 rounded-xl transition-colors" title="Lihat Detail"><i class="fas fa-eye text-xs"></i></a>
                                <form action="{{ route('admin.verifikasi.berkas.approve', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Verifikasi pendaftaran mahasiswa ini?')">
                                    @csrf
                                    <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-xl transition-colors" title="Setujui"><i class="fas fa-check text-xs"></i></button>
                                </form>
                                <form action="{{ route('admin.pendaftaran.reject', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak pendaftaran mahasiswa ini?')">
                                    @csrf
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Tolak"><i class="fas fa-times text-xs"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 font-medium italic">Belum ada data pendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-50 flex items-center justify-between">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Halaman {{ $all_pendaftaran->currentPage() }} dari {{ $all_pendaftaran->lastPage() }}</span>
            <div class="flex gap-2">
                @if($all_pendaftaran->onFirstPage())
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Mundur</span>
                @else
                    <a href="{{ $all_pendaftaran->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Mundur</a>
                @endif

                @if($all_pendaftaran->hasMorePages())
                    <a href="{{ $all_pendaftaran->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Maju</a>
                @else
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Maju</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
