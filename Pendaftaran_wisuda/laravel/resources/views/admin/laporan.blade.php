@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Laporan & Statistik</h2>
        <p class="text-gray-500 font-medium">Laporan komprehensif pelaksanaan wisuda dan data keuangan.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-wallet text-xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
            <h3 class="text-3xl font-black text-gray-800">Rp {{ number_format(\App\Models\Pendaftaran::where('status', 'terverifikasi')->count() * 500000, 0, ',', '.') }}</h3>
            <p class="text-xs text-emerald-500 font-bold mt-2"><i class="fas fa-arrow-up mr-1"></i> Berdasarkan pembayaran valid</p>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-user-graduate text-xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Wisudawan</p>
            <h3 class="text-3xl font-black text-gray-800">{{ \App\Models\Pendaftaran::where('status', 'terverifikasi')->count() }}</h3>
            <p class="text-xs text-blue-500 font-bold mt-2"><i class="fas fa-check-circle mr-1"></i> Terverifikasi akhir</p>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Menunggu Proses</p>
            <h3 class="text-3xl font-black text-gray-800">{{ \App\Models\Pendaftaran::where('status', 'menunggu')->count() }}</h3>
            <p class="text-xs text-amber-500 font-bold mt-2"><i class="fas fa-exclamation-circle mr-1"></i> Perlu verifikasi berkas</p>
        </div>
    </div>

    <!-- Report Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Keuangan -->
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-10">
                <h4 class="font-black text-gray-800 text-xl">Ringkasan Keuangan</h4>
                <a href="{{ route('admin.export.laporan.keuangan') }}" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-[#0b3c39] hover:text-white transition-all shadow-sm border border-gray-100">
                    <i class="fas fa-download text-xs"></i>
                </a>
            </div>
            
            <div class="space-y-6">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Pembayaran Masuk</p>
                        <p class="text-lg font-bold text-gray-700">Validasi Selesai</p>
                    </div>
                    <p class="text-xl font-black text-[#0b3c39]">Rp {{ number_format(\App\Models\Pendaftaran::where('status', 'terverifikasi')->count() * 500000, 0, ',', '.') }}</p>
                </div>
                <div class="w-full bg-gray-50 h-3 rounded-full overflow-hidden">
                    <div class="bg-[#0b3c39] h-full rounded-full" style="width: 100%"></div>
                </div>

                <div class="flex justify-between items-end pt-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Menunggu Pembayaran</p>
                        <p class="text-lg font-bold text-gray-700">Potensi Pendapatan</p>
                    </div>
                    @php
                        $potensiCount = \App\Models\Pendaftaran::where('status', 'menunggu_pembayaran')->count();
                    @endphp
                    <p class="text-xl font-black text-amber-500">Rp {{ number_format($potensiCount * 500000, 0, ',', '.') }}</p>
                </div>
                <div class="w-full bg-gray-50 h-3 rounded-full overflow-hidden">
                    <div class="bg-amber-400 h-full rounded-full" style="width: {{ $potensiCount > 0 ? 30 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Sebaran Prodi -->
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            <h4 class="font-black text-gray-800 text-xl mb-10">Sebaran Program Studi</h4>
            <div class="space-y-6">
                @php
                    $prodis = \App\Models\Pendaftaran::select('program_studi', \DB::raw('count(*) as total'))
                        ->groupBy('program_studi')
                        ->get();
                    $totalAll = \App\Models\Pendaftaran::count();
                @endphp
                @foreach($prodis as $p)
                @php $percent = $totalAll > 0 ? ($p->total / $totalAll) * 100 : 0; @endphp
                <div class="space-y-2">
                    <div class="flex justify-between text-sm font-bold">
                        <span class="text-gray-700">{{ $p->program_studi }}</span>
                        <span class="text-[#0b3c39]">{{ $p->total }} Mhs</span>
                    </div>
                    <div class="w-full bg-gray-50 h-3 rounded-full overflow-hidden">
                        <div class="bg-[#0b3c39] h-full rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
