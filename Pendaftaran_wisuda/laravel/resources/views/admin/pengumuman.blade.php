@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Manajemen Pengumuman</h2>
            <p class="text-gray-500 font-medium">Terbitkan berkas informasi atau agenda terbaru untuk mahasiswa.</p>
        </div>
        <button onclick="document.getElementById('modal-tambah').classList.remove('hidden')" class="px-6 py-3 bg-[#0b3c39] text-white rounded-2xl font-bold text-sm shadow-lg shadow-emerald-900/20 hover:bg-emerald-900 flex items-center gap-2">
            <i class="fas fa-plus"></i> Buat Pengumuman
        </button>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl font-bold text-sm flex items-center gap-3">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @forelse($announcements as $item)
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-start md:items-center gap-6 group hover:shadow-xl hover:shadow-emerald-900/5 transition-all">
            <div class="w-16 h-16 {{ $item->type == 'penting' ? 'bg-red-50 text-red-500' : ($item->type == 'agenda' ? 'bg-amber-50 text-amber-500' : 'bg-blue-50 text-blue-500') }} rounded-2xl flex items-center justify-center shrink-0">
                <i class="fas {{ $item->type == 'penting' ? 'fa-exclamation-circle' : ($item->type == 'agenda' ? 'fa-calendar-alt' : 'fa-info-circle') }} text-2xl"></i>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-1">
                    <span class="text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-lg {{ $item->type == 'penting' ? 'bg-red-500 text-white' : ($item->type == 'agenda' ? 'bg-amber-400 text-white' : 'bg-blue-500 text-white') }}">
                        {{ $item->type }}
                    </span>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $item->created_at->format('d M Y') }}</span>
                </div>
                <h4 class="text-xl font-black text-gray-800 leading-tight mb-2">{{ $item->title }}</h4>
                <p class="text-gray-500 text-sm font-medium line-clamp-2">{{ $item->content }}</p>
            </div>
            <div class="flex gap-2">
                <button onclick="showEditModal({{ json_encode($item) }})" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-600 transition-all">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="{{ route('admin.pengumuman.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white p-12 rounded-[2.5rem] shadow-sm border border-gray-100 text-center">
            <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-bullhorn text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800">Belum Ada Pengumuman</h3>
            <p class="text-gray-500 max-w-sm mx-auto mt-2">Mulai buat pengumuman pertama Anda untuk memberikan informasi kepada mahasiswa.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah -->
<div id="modal-tambah" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 md:p-12">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-black text-gray-800">Buat Pengumuman Baru</h3>
                <button onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Pengumuman</label>
                    <input type="text" name="title" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700" placeholder="Contoh: Jadwal Gladi Bersih Wisuda">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe Pengumuman</label>
                        <select name="type" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 appearance-none">
                            <option value="info">Info Umum</option>
                            <option value="penting">Penting / Urgent</option>
                            <option value="agenda">Agenda Kegiatan</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal (Opsional)</label>
                        <input type="date" name="date" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Isi Pengumuman</label>
                    <textarea name="content" required rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 resize-none" placeholder="Tuliskan isi pengumuman secara detail..."></textarea>
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="document.getElementById('modal-tambah').classList.add('hidden')" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                    <button type="submit" class="flex-2 px-12 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Terbitkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div id="modal-edit" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 md:p-12">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-black text-gray-800">Edit Pengumuman</h3>
                <button onclick="document.getElementById('modal-edit').classList.add('hidden')" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="form-edit" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Pengumuman</label>
                    <input type="text" name="title" id="edit-title" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe Pengumuman</label>
                        <select name="type" id="edit-type" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 appearance-none">
                            <option value="info">Info Umum</option>
                            <option value="penting">Penting / Urgent</option>
                            <option value="agenda">Agenda Kegiatan</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal (Opsional)</label>
                        <input type="date" name="date" id="edit-date" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Isi Pengumuman</label>
                    <textarea name="content" id="edit-content" required rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700 resize-none"></textarea>
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                    <button type="submit" class="flex-2 px-12 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showEditModal(item) {
        document.getElementById('form-edit').action = `/admin/pengumuman/${item.id}`;
        document.getElementById('edit-title').value = item.title;
        document.getElementById('edit-type').value = item.type;
        document.getElementById('edit-content').value = item.content;
        
        document.getElementById('modal-edit').classList.remove('hidden');
    }
</script>
@endsection
