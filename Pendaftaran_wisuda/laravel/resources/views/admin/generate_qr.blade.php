@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Generate QR Code</h2>
            <p class="text-gray-500 font-medium">Buat kode QR akses untuk mahasiswa dan tamu undangan.</p>
        </div>
        <div class="flex gap-4">
            <form action="{{ route('admin.generate.qr.bulk') }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 bg-[#0b3c39] text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-900/20 hover:bg-emerald-900 flex items-center gap-2">
                    <i class="fas fa-qrcode"></i> Generate Semua
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Stats -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h3 class="text-lg font-black text-gray-800 mb-6">Ringkasan QR</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-600">Total Wisudawan</span>
                        </div>
                        <span class="text-lg font-black text-gray-800">{{ $students->count() }}</span>
                    </div>
                </div>
                <div class="mt-8 p-6 bg-emerald-50 rounded-[2rem] border border-emerald-100">
                    <p class="text-xs font-black text-emerald-800 uppercase tracking-widest mb-2">INFO SISTEM</p>
                    <p class="text-sm font-medium text-emerald-700 leading-relaxed">QR Code yang dibuat dapat langsung digunakan mahasiswa pada halaman dashboard mereka.</p>
                </div>
            </div>
        </div>

        <!-- Student List for QR -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                    <h3 class="font-black text-gray-800">Daftar Mahasiswa Terverifikasi</h3>
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                        <input type="text" placeholder="Cari mahasiswa..." class="pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-xs font-bold focus:ring-2 focus:ring-[#0b3c39]/20 w-64">
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/30">
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Mahasiswa</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">Prog. Studi</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($students as $student)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-8 py-5">
                                    <p class="font-bold text-gray-800">{{ $student->nama_mahasiswa }}</p>
                                    <p class="text-xs text-gray-400 font-medium">{{ $student->nim }}</p>
                                </td>
                                <td class="px-8 py-5 font-bold text-gray-500 text-xs italic">{{ $student->program_studi }}</td>
                                <td class="px-8 py-5 text-right">
                                    <form action="{{ route('admin.generate.qr.single', $student->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-gray-50 text-[#0b3c39] rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#0b3c39] hover:text-white transition-all">Generate</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest">Tidak ada mahasiswa terverifikasi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
