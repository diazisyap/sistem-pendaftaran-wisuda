@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Manajemen Jadwal Wisuda</h2>
            <p class="text-gray-500 font-medium">Atur sesi dan waktu pelaksanaan acara wisuda mahasiswa.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah-jadwal').classList.remove('hidden')" class="px-6 py-3 bg-[#0b3c39] text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-900/20 hover:bg-emerald-900 flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </button>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($jadwal as $item)
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative group transition-all hover:bg-white hover:shadow-2xl hover:shadow-emerald-900/5">
            <div class="absolute top-6 right-6 flex gap-2">
                <button onclick="showEditModal({{ json_encode($item) }})" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-emerald-50 hover:text-[#0b3c39] shadow-sm border border-gray-100 transition-all"><i class="fas fa-edit text-xs"></i></button>
                <form action="{{ route('admin.jadwal.wisuda.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 shadow-sm border border-gray-100 transition-all"><i class="fas fa-trash text-xs"></i></button>
                </form>
            </div>
            <div class="w-14 h-14 bg-emerald-50 text-[#0b3c39] rounded-2xl flex items-center justify-center mb-8">
                <i class="fas fa-calendar-alt text-2xl"></i>
            </div>
            <h4 class="font-black text-gray-800 text-xl mb-6">{{ $item->nama_sesi }}</h4>
            <div class="space-y-4 mb-8">
                <div class="flex items-center text-sm font-medium text-gray-500">
                    <i class="fas fa-clock w-8 text-[#0b3c39]"></i>
                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}, {{ $item->waktu }}</span>
                </div>
                <div class="flex items-center text-sm font-medium text-gray-500">
                    <i class="fas fa-map-marker-alt w-8 text-[#0b3c39]"></i>
                    <span>{{ $item->lokasi }}</span>
                </div>
                <div class="flex items-center text-sm font-medium text-gray-500">
                    <i class="fas fa-users w-8 text-[#0b3c39]"></i>
                    <span>Kuota: {{ $item->kuota }} Peserta</span>
                </div>
            </div>
            <div class="flex items-center justify-between pt-6 border-t border-gray-50 mt-auto">
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[10px] font-black tracking-widest uppercase">AKTIF</span>
                <button class="text-[#0b3c39] text-xs font-black uppercase tracking-widest hover:underline">Kelola Peserta <i class="fas fa-chevron-right ml-1"></i></button>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white p-12 rounded-[2.5rem] shadow-sm border border-gray-100 text-center">
            <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-calendar-plus text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Belum Ada Jadwal</h3>
            <p class="text-gray-500 max-w-sm mx-auto mt-2">Atur sesi wisuda pertama Anda untuk mulai menerima pendaftaran sesuai gelombang.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Jadwal -->
<div id="modal-tambah-jadwal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm">
    <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 md:p-12">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-black text-gray-800">Tambah Jadwal Wisuda</h3>
                <button onclick="document.getElementById('modal-tambah-jadwal').classList.add('hidden')" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.jadwal.wisuda.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Sesi / Gelombang</label>
                    <input type="text" name="nama_sesi" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700" placeholder="Contoh: Wisuda Gelombang I 2026">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                        <input type="date" name="tanggal" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Waktu</label>
                        <input type="text" name="waktu" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700" placeholder="08:00 WIB">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Gedung</label>
                    <input type="text" name="lokasi" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700" placeholder="Gedung Auditorium Pusat">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kuota Peserta</label>
                    <input type="number" name="kuota" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700" placeholder="500">
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="document.getElementById('modal-tambah-jadwal').classList.add('hidden')" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                    <button type="submit" class="flex-2 px-12 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Jadwal -->
<div id="modal-edit-jadwal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm">
    <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 md:p-12">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-black text-gray-800">Edit Jadwal Wisuda</h3>
                <button onclick="document.getElementById('modal-edit-jadwal').classList.add('hidden')" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="form-edit-jadwal" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Sesi / Gelombang</label>
                    <input type="text" name="nama_sesi" id="edit-nama-sesi" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                        <input type="date" name="tanggal" id="edit-tanggal" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 text-sm">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Waktu</label>
                        <input type="text" name="waktu" id="edit-waktu" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Gedung</label>
                    <input type="text" name="lokasi" id="edit-lokasi" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kuota Peserta</label>
                    <input type="number" name="kuota" id="edit-kuota" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="document.getElementById('modal-edit-jadwal').classList.add('hidden')" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                    <button type="submit" class="flex-2 px-12 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Perbarui Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showEditModal(item) {
        document.getElementById('form-edit-jadwal').action = `/admin/jadwal-wisuda/${item.id}`;
        document.getElementById('edit-nama-sesi').value = item.nama_sesi;
        document.getElementById('edit-tanggal').value = item.tanggal;
        document.getElementById('edit-waktu').value = item.waktu;
        document.getElementById('edit-lokasi').value = item.lokasi;
        document.getElementById('edit-kuota').value = item.kuota;
        
        document.getElementById('modal-edit-jadwal').classList.remove('hidden');
    }
</script>
@endsection
