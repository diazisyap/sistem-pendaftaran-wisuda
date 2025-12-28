@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <!-- Summary Header -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-[#0b3c39] p-8 rounded-[2.5rem] shadow-lg text-white">
            <p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest mb-1">Total Mahasiswa</p>
            <h3 class="text-4xl font-black italic">{{ \App\Models\User::where('role', 'student')->count() }}</h3>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Pendaftar</p>
            <h3 class="text-4xl font-black text-gray-800 italic">{{ \App\Models\Pendaftaran::count() }}</h3>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Terverifikasi</p>
            <h3 class="text-4xl font-black text-emerald-600 italic">{{ \App\Models\Pendaftaran::where('status', 'terverifikasi')->count() }}</h3>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Ditolak</p>
            <h3 class="text-4xl font-black text-red-500 italic">{{ \App\Models\Pendaftaran::where('status', 'ditolak')->count() }}</h3>
        </div>
    </div>

    <!-- Student List -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <h3 class="font-black text-gray-800 text-xl">Daftar Akun Mahasiswa</h3>
            <form action="{{ route('admin.manajemen.mahasiswa') }}" method="GET" class="flex items-center bg-gray-50 px-6 py-3 rounded-2xl w-full md:w-80 border border-gray-100 focus-within:border-[#0b3c39]/30 transition-all">
                <i class="fas fa-search text-gray-400 mr-3 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIM atau Nama..." class="bg-transparent border-none focus:ring-0 text-xs font-bold w-full placeholder:text-gray-300">
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">NIM</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status Akun</th>
                        <th class="px-8 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($students as $student)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-6 text-sm font-black text-gray-400">{{ $student->pendaftaran->nim ?? '-' }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center font-black text-xs text-gray-500 border border-gray-200 shadow-sm">
                                    @if($student->avatar)
                                        <img src="{{ \Storage::url($student->avatar) }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        {{ strtoupper(substr($student->name, 0, 2)) }}
                                    @endif
                                </div>
                                <p class="font-bold text-gray-800">{{ $student->name }}</p>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-gray-500">{{ $student->email }}</td>
                        <td class="px-8 py-6">
                             <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black tracking-widest uppercase border border-green-100">AKTIF</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2">
                                <button onclick="showEditModal({{ json_encode($student) }})" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-[#0b3c39] hover:text-white transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <form action="{{ route('admin.manajemen.mahasiswa.delete', $student->id) }}" method="POST" onsubmit="return confirm('Hapus akun mahasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-gray-400 font-bold uppercase text-[10px] tracking-widest italic">Belum ada akun mahasiswa terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-6 border-t border-gray-50 flex items-center justify-between">
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Halaman {{ $students->currentPage() }} dari {{ $students->lastPage() }}</span>
            <div class="flex gap-2">
                @if($students->onFirstPage())
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Mundur</span>
                @else
                    <a href="{{ $students->appends(request()->query())->previousPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Mundur</a>
                @endif

                @if($students->hasMorePages())
                    <a href="{{ $students->appends(request()->query())->nextPageUrl() }}" class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-[#0b3c39] uppercase tracking-widest hover:bg-gray-50 transition-all">Maju</a>
                @else
                    <span class="px-4 py-2 border border-gray-100 rounded-xl text-[10px] font-black text-gray-300 uppercase tracking-widest cursor-not-allowed">Maju</span>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Mahasiswa -->
<div id="modal-edit-mahasiswa" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm">
    <div class="bg-white w-full max-w-md rounded-[3rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 md:p-10">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-black text-gray-800">Edit Akun</h3>
                <button onclick="document.getElementById('modal-edit-mahasiswa').classList.add('hidden')" class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="form-edit-mahasiswa" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Mahasiswa</label>
                    <input type="text" name="name" id="edit-name" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Email</label>
                    <input type="email" name="email" id="edit-email" required class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 font-bold text-gray-700">
                </div>

                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="document.getElementById('modal-edit-mahasiswa').classList.add('hidden')" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">Batal</button>
                    <button type="submit" class="flex-2 px-10 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-[1.02] transition-all">Update Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showEditModal(user) {
        document.getElementById('form-edit-mahasiswa').action = `/admin/manajemen-mahasiswa/${user.id}`;
        document.getElementById('edit-name').value = user.name;
        document.getElementById('edit-email').value = user.email;
        
        document.getElementById('modal-edit-mahasiswa').classList.remove('hidden');
    }
</script>
@endsection
