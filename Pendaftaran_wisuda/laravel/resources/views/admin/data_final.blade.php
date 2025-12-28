@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Data Final Wisudawan</h2>
            <p class="text-gray-500 font-medium">Daftar mahasiswa yang telah memenuhi seluruh persyaratan wisuda.</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <form action="{{ route('admin.data.final') }}" method="GET" class="flex items-center bg-white border border-gray-200 px-4 py-2 rounded-2xl focus-within:border-[#0b3c39]/30 transition-all">
                <i class="fas fa-search text-gray-400 mr-2 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari wisudawan..." class="bg-transparent border-none focus:ring-0 text-xs font-bold w-40 placeholder:text-gray-300">
            </form>
            <a href="{{ route('admin.export.final') }}" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-2xl font-bold text-sm shadow-sm hover:bg-gray-50 flex items-center gap-2">
                <i class="fas fa-file-export"></i> Export CSV
            </a>
            <button onclick="window.print()" class="px-6 py-3 bg-[#0b3c39] text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-900/20 hover:bg-emerald-900 flex items-center gap-2">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>

    @if($final_students->isEmpty())
        <div class="bg-white p-12 rounded-[2.5rem] shadow-sm border border-gray-100 text-center">
            <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-user-slash text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Belum Ada Data Final</h3>
            <p class="text-gray-500 max-w-sm mx-auto mt-2">Belum ada mahasiswa yang statusnya 'terverifikasi' untuk ditampilkan di daftar final.</p>
        </div>
    @else
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center w-16">No</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Mahasiswa</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Program Studi</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">IPK</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($final_students as $index => $student)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-8 py-6 font-bold text-gray-400 text-center">{{ ($final_students->currentPage() - 1) * $final_students->perPage() + $loop->iteration }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-[#0b3c39] font-black text-xs">
                                        {{ strtoupper(substr($student->nama_mahasiswa, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $student->nama_mahasiswa }}</p>
                                        <p class="text-xs text-gray-400 font-medium">{{ $student->nim }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-gray-700">{{ $student->program_studi }}</p>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ $student->fakultas }}</p>
                            </td>
                            <td class="px-8 py-6 font-black text-[#0b3c39]">{{ number_format($student->ipk ?? 0, 2) }}</td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black tracking-widest uppercase border border-emerald-100">TERVERIFIKASI</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('admin.verifikasi.berkas.detail', $student->id) }}" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#0b3c39] hover:text-white transition-all">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Halaman {{ $final_students->currentPage() }} dari {{ $final_students->lastPage() }}</span>
                <div class="flex gap-2">
                    @if($final_students->onFirstPage())
                        <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Mundur</span>
                    @else
                        <a href="{{ $final_students->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Mundur</a>
                    @endif

                    @if($final_students->hasMorePages())
                        <a href="{{ $final_students->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Maju</a>
                    @else
                        <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Maju</span>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
