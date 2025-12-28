@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center space-x-4 mb-2">
        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-[#0b3c39] shadow-sm">
            <i class="fas fa-user-cog text-xl"></i>
        </div>
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Pengaturan Akun</h2>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center shadow-sm animate-pulse">
            <i class="fas fa-check-circle mr-3 text-lg"></i>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Sidebar Settings -->
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="relative">
                        <img id="avatar-preview-sidebar" src="{{ $user->avatar ? \Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0b3c39&color=fff&size=128' }}" class="w-24 h-24 rounded-[2rem] shadow-lg border-4 border-white object-cover" alt="Avatar">
                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="absolute -bottom-2 -right-2 w-10 h-10 bg-white shadow-md rounded-xl flex items-center justify-center text-gray-400 hover:text-[#0b3c39] border border-gray-50 transition-all">
                            <i class="fas fa-camera text-sm"></i>
                        </button>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-800 tracking-tight">{{ $user->name }}</h4>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $user->role }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#0b3c39] p-6 rounded-[2rem] shadow-lg shadow-emerald-900/10 text-white">
                <h5 class="text-xs font-black uppercase tracking-widest mb-4 opacity-50">Keamanan</h5>
                <p class="text-sm font-medium leading-relaxed">Pastikan password Anda kuat dan unik untuk menjaga keamanan akun pendaftaran wisuda Anda.</p>
            </div>
        </div>

        <!-- Form Settings -->
        <div class="md:col-span-2 space-y-8">
            <!-- Profile Info -->
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-gray-800 flex items-center">
                        <i class="fas fa-id-badge mr-3 text-[#0b3c39]"></i> Informasi Profil
                    </h3>
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] font-black text-red-500 uppercase tracking-widest border border-red-100 px-3 py-1 rounded-full">Ketentuan Foto Resmi</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8 p-6 bg-red-50 rounded-3xl border border-red-100">
                    <div class="lg:col-span-1 flex justify-center">
                        <div class="relative">
                            <img id="avatar-preview" src="{{ $user->avatar ? \Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0b3c39&color=fff&size=128' }}" class="w-32 h-32 rounded-2xl shadow-md border-4 border-white object-cover" alt="Avatar">
                            <label for="avatar-input" class="absolute -bottom-2 -right-2 w-10 h-10 bg-[#0b3c39] text-white shadow-lg rounded-xl flex items-center justify-center cursor-pointer hover:bg-emerald-900 transition-all">
                                <i class="fas fa-camera text-sm"></i>
                            </label>
                        </div>
                    </div>
                    <div class="lg:col-span-3">
                        <h5 class="text-sm font-black text-gray-800 uppercase tracking-tight mb-3">Persyaratan Foto Profil:</h5>
                        <ul class="space-y-2">
                            <li class="flex items-center text-xs font-bold text-gray-600">
                                <i class="fas fa-check-circle text-emerald-500 mr-2"></i> Foto Formal (Wajah Tegak Lurus)
                            </li>
                            <li class="flex items-center text-xs font-bold text-gray-600">
                                <i class="fas fa-check-circle text-emerald-500 mr-2"></i> Latar Belakang (Background) Berwarna Merah
                            </li>
                            <li class="flex items-center text-xs font-bold text-gray-600">
                                <i class="fas fa-check-circle text-emerald-500 mr-2"></i> Wajib Menggunakan Almamater Kampus
                            </li>
                            <li class="flex items-center text-xs font-bold text-gray-600">
                                <i class="fas fa-check-circle text-emerald-500 mr-2"></i> Format: JPG/PNG, Max: 2MB
                            </li>
                        </ul>
                    </div>
                </div>
                
                <form action="{{ route('student.settings.profile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <input type="file" name="avatar" id="avatar-input" class="hidden" onchange="previewImage(this)">
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" name="email" value="{{ $user->email }}" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-emerald-900/5 hover:bg-emerald-900 transition-all">
                        SIMPAN PERUBAHAN
                    </button>
                </form>
            </div>

            <script>
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('avatar-preview').src = e.target.result;
                            document.getElementById('avatar-preview-sidebar').src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

            <!-- Change Password -->
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-gray-800 mb-8 flex items-center">
                    <i class="fas fa-key mr-3 text-amber-500"></i> Ubah Password
                </h3>
                
                <form action="{{ route('student.settings.password') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Sekarang</label>
                        <input type="password" name="current_password" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 transition-all font-bold text-gray-700" placeholder="••••••••">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Password Baru</label>
                            <input type="password" name="new_password" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 transition-all font-bold text-gray-700" placeholder="Min. 8 Karakter">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                            <input type="password" name="new_password_confirmation" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 transition-all font-bold text-gray-700" placeholder="Ketik Ulang Password">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-amber-400 text-amber-950 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-amber-900/5 hover:bg-amber-500 transition-all">
                        UPDATE PASSWORD
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
