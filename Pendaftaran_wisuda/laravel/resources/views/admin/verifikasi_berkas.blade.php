@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="bg-[#0b3c39] rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden shadow-2xl shadow-emerald-900/20">
        <!-- Decorative Background -->
        <i class="fas fa-id-card absolute -right-6 -bottom-6 text-9xl text-white/5 rotate-12"></i>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -mr-16 -mt-16"></div>
        
        <div class="relative z-10">
            <a href="{{ route('admin.verifikasi.berkas') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 text-white rounded-xl text-xs font-bold hover:bg-white/20 transition-all backdrop-blur-md mb-6 border border-white/10">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            
            <div class="md:flex md:items-end md:justify-between gap-8">
                <div class="max-w-2xl">
                    <span class="inline-block py-1 px-3 rounded-lg bg-emerald-400/20 text-emerald-300 text-[10px] font-black tracking-widest uppercase mb-2 border border-emerald-400/20">Detail Pendaftar</span>
                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-2">{{ $pendaftaran->nama_mahasiswa }}</h2>
                    <p class="text-emerald-100/70 font-medium text-sm">NIM: {{ $pendaftaran->nim }} • Program Studi: {{ $pendaftaran->program_studi }}</p>
                </div>
                
                <div class="mt-6 md:mt-0">
                    <div class="flex items-center gap-3">
                         <div class="px-4 py-2 bg-white/10 rounded-xl border border-white/10 backdrop-blur-md text-center">
                            <span class="block text-[10px] text-emerald-200 uppercase tracking-widest font-bold">Status</span>
                            <span class="block text-white font-black text-sm">{{ ucfirst($pendaftaran->status ?? 'Menunggu') }}</span>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Identity Card -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 h-full">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-id-card text-[#0b3c39] mr-3"></i>
                Identitas Mahasiswa
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">NIM</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendaftaran->nim }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendaftaran->nama_mahasiswa }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Program Studi</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendaftaran->program_studi }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Fakultas</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendaftaran->fakultas ?? '-' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">IPK</p>
                    <p class="text-lg font-black text-[#0b3c39]">{{ number_format($pendaftaran->ipk ?? 0, 2) }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email Aktif</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendaftaran->email_aktif }}</p>
                </div>
            </div>
        </div>

        <!-- Cost Detail Card (Added as requested) -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 h-full">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-receipt text-[#0b3c39] mr-3"></i>
                Rincian Tagihan
            </h3>

            <div class="space-y-4">
                @php
                    $adminFee = 500000;
                    $togaFee = 250000;
                    $extraSeats = $pendaftaran->jumlah_kursi_tambahan ?? 0;
                    $extraCost = $extraSeats * 150000;
                    $total = $adminFee + $togaFee + $extraCost;
                @endphp
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Biaya Pendaftaran</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">Administrasi</p>
                    </div>
                    <span class="font-black text-gray-700">Rp 500.000</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-2xl">
                    <div>
                         <p class="font-bold text-gray-800 text-sm">Atribut Wisuda</p>
                         <p class="text-[10px] text-gray-400 uppercase tracking-wide">Toga & Kelengkapan</p>
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
                    <span class="font-black text-gray-400 text-xs uppercase tracking-widest">Estimasi Total</span>
                    <span class="font-black text-2xl text-[#0b3c39]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 text-lg">Daftar Dokumen Persyaratan</h3>
            <span class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black tracking-widest uppercase border border-amber-100">Menunggu Review</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Nama Dokumen</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500">File</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php
                        $docs = [
                            'foto_formal' => 'Pas Foto Formal (3x4)',
                            'foto_bebas' => 'Pas Foto Bebas',
                            'surat_pernyataan' => 'Surat Pernyataan',
                            'transkip_nilai' => 'Transkrip Nilai Terakhir',
                            'krs_terpenuhi' => 'Bukti KRS Terpenuhi',
                        ];
                        $berkas = $pendaftaran->berkas;
                    @endphp
                    @foreach($docs as $key => $name)
                    @php 
                        $file = $berkas->$key; 
                        $statusKey = 'status_' . $key;
                        $status = $berkas->$statusKey ?? 'pending';
                    @endphp
                    <tr>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-gray-800">{{ $name }}</p>
                            @php $catatanKey = 'catatan_' . $key; @endphp
                            @if($berkas->$catatanKey)
                                <p class="text-[10px] text-red-500 font-medium mt-1"><i class="fas fa-info-circle mr-1"></i> {{ $berkas->$catatanKey }}</p>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium
                                {{ $status == 'terverifikasi' ? 'bg-green-100 text-green-800' : ($status == 'revisi' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($file)
                            <a href="{{ \Storage::url($file) }}" target="_blank" class="text-[#0b3c39] font-bold text-xs hover:underline flex items-center gap-1">
                                <i class="fas fa-paperclip"></i> Lihat File
                            </a>
                            @else
                            <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                             <div class="flex justify-end gap-2">
                                <form action="{{ route('admin.verifikasi.berkas.doc.update', [$pendaftaran->id, $key]) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="terverifikasi">
                                    <button type="submit" title="Setujui" class="w-8 h-8 rounded-lg {{ $status == 'terverifikasi' ? 'bg-emerald-600 text-white shadow-emerald-200' : 'bg-white border border-gray-200 text-gray-400 hover:text-emerald-600 hover:border-emerald-200' }} flex items-center justify-center transition-all shadow-sm">
                                        <i class="fas fa-check text-xs"></i>
                                    </button>
                                </form>
                                <button onclick="showRevisionModal('{{ $key }}', '{{ $name }}')" title="Minta Revisi" class="w-8 h-8 rounded-lg {{ $status == 'revisi' ? 'bg-red-600 text-white shadow-red-200' : 'bg-white border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-200' }} flex items-center justify-center transition-all shadow-sm">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-8 bg-gray-50/50 border-t border-gray-100 flex items-center justify-end gap-4">
             @if(in_array($pendaftaran->status, ['terverifikasi', 'lulus_verifikasi_berkas']))
             <form action="{{ route('admin.verifikasi.berkas.reject', $pendaftaran->id) }}" method="POST">
                 @csrf
                 <input type="hidden" name="alasan" value="Reset status verifikasi oleh admin">
                 <button type="submit" onclick="return confirm('Batalkan status verifikasi? Status akan menjadi Ditolak/Revisi agar bisa diverifikasi ulang.')" class="px-8 py-4 text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all">
                     <i class="fas fa-undo-alt mr-2"></i> Batalkan / Edit Status
                 </button>
             </form>
             <div class="px-12 py-4 bg-emerald-50 text-emerald-600 rounded-2xl font-black text-sm uppercase tracking-widest border border-emerald-100 flex items-center cursor-default">
                 Terverifikasi <i class="fas fa-check-double ml-2"></i>
             </div>
             @else
             <form action="{{ route('admin.verifikasi.berkas.approve', $pendaftaran->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-12 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">
                    Konfirmasi Verifikasi <i class="fas fa-check-double ml-2"></i>
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

<!-- Revision Modal -->
<div id="revisiModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl scale-95 opacity-0 transition-all duration-300 transform" id="modalContent">
        <h3 class="text-xl font-black text-gray-800 mb-2">Minta Revisi</h3>
        <p class="text-gray-400 font-medium mb-6" id="docNameLabel">Dokumen: Pas Foto Formal</p>
        
        <form id="revisiForm" method="POST">
            @csrf
            <input type="hidden" name="status" value="revisi">
            <div class="space-y-4">
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest ml-1">Catatan Revisi</label>
                <textarea name="catatan" rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 resize-none" placeholder="Jelaskan alasan revisi..." required></textarea>
            </div>
            <div class="mt-8 flex gap-3">
                <button type="button" onclick="closeRevisionModal()" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                <button type="submit" class="flex-2 px-8 py-4 bg-red-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 transition-all shadow-lg shadow-red-500/20">Kirim Revisi</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showRevisionModal(key, name) {
        const modal = document.getElementById('revisiModal');
        const content = document.getElementById('modalContent');
        const form = document.getElementById('revisiForm');
        const label = document.getElementById('docNameLabel');
        
        label.innerText = 'Dokumen: ' + name;
        form.action = `/admin/verifikasi-berkas/{{ $pendaftaran->id }}/doc/${key}`;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeRevisionModal() {
        const modal = document.getElementById('revisiModal');
        const content = document.getElementById('modalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection
