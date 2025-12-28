@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Stepper Header -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 py-4 mb-4">
        @php
            $isStep1Done = $pendaftaran ? true : false;
            $isStep2Done = $pendaftaran && $pendaftaran->berkas ? true : false;
            $isStep3Done = $pendaftaran && $pendaftaran->status == 'terverifikasi' ? true : false;
        @endphp

        <!-- Step 1 -->
        <div class="flex items-center space-x-4 w-full md:w-auto">
            <div class="w-10 h-10 {{ $isStep1Done ? 'bg-emerald-500 shadow-emerald-100' : 'bg-[#0b3c39] shadow-emerald-100' }} text-white rounded-2xl flex items-center justify-center font-bold shadow-lg transition-all duration-500">
                @if($isStep1Done)
                    <i class="fas fa-check"></i>
                @else
                    <i class="fas fa-id-card"></i>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-black {{ $isStep1Done ? 'text-emerald-500' : 'text-[#0b3c39]' }} uppercase tracking-widest">Langkah 1</p>
                <h4 class="text-sm font-black {{ $isStep1Done ? 'text-emerald-600' : 'text-gray-800' }} uppercase">Input Identitas</h4>
            </div>
        </div>
        
        <div class="hidden md:block flex-1 h-[2px] {{ $isStep1Done ? 'bg-emerald-100' : 'bg-gray-100' }} mx-4"></div>

        <!-- Step 2 -->
        <div class="flex items-center space-x-4 w-full md:w-auto {{ $isStep1Done ? '' : 'opacity-40' }}">
            <div class="w-10 h-10 {{ $isStep2Done ? 'bg-emerald-500 shadow-emerald-100' : ($isStep1Done ? 'bg-[#0b3c39]' : 'bg-gray-200') }} {{ $isStep2Done || $isStep1Done ? 'text-white' : 'text-gray-500' }} rounded-2xl flex items-center justify-center font-bold shadow-lg transition-all duration-500">
                @if($isStep2Done)
                    <i class="fas fa-check"></i>
                @else
                    <i class="fas fa-file-alt"></i>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-black {{ $isStep2Done ? 'text-emerald-500' : ($isStep1Done ? 'text-[#0b3c39]' : 'text-gray-400') }} uppercase tracking-widest">Langkah 2</p>
                <h4 class="text-sm font-black {{ $isStep2Done ? 'text-emerald-600' : ($isStep1Done ? 'text-gray-800' : 'text-gray-400') }} uppercase">Dokumen</h4>
            </div>
        </div>

        <div class="hidden md:block flex-1 h-[2px] {{ $isStep2Done ? 'bg-emerald-100' : 'bg-gray-100' }} mx-4"></div>

        <!-- Step 3 -->
        <div class="flex items-center space-x-4 w-full md:w-auto {{ $isStep2Done ? '' : 'opacity-40' }}">
            <div class="w-10 h-10 {{ $isStep3Done ? 'bg-emerald-500 shadow-emerald-100' : ($isStep2Done ? 'bg-[#0b3c39]' : 'bg-gray-200') }} {{ $isStep3Done || $isStep2Done ? 'text-white' : 'text-gray-500' }} rounded-2xl flex items-center justify-center font-bold shadow-lg transition-all duration-500">
                @if($isStep3Done)
                    <i class="fas fa-check"></i>
                @else
                    <i class="fas fa-wallet"></i>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-black {{ $isStep3Done ? 'text-emerald-500' : ($isStep2Done ? 'text-[#0b3c39]' : 'text-gray-400') }} uppercase tracking-widest">Langkah 3</p>
                <h4 class="text-sm font-black {{ $isStep3Done ? 'text-emerald-600' : ($isStep2Done ? 'text-gray-800' : 'text-gray-400') }} uppercase">Pembayaran</h4>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
        <!-- Decorative background icon -->
        <i class="fas fa-file-signature absolute -bottom-10 -right-10 text-[15rem] text-gray-50 opacity-50 -rotate-12 pointer-events-none"></i>

        <div class="relative z-10">
            @if(!$pendaftaran || (isset($is_editing) && $is_editing))
            <div class="mb-10 text-center md:text-left">
                <h3 class="text-2xl font-black text-gray-800 mb-2">{{ isset($is_editing) ? 'Edit Data Pendaftaran' : 'Formulir Pendaftaran Wisuda' }}</h3>
                <p class="text-gray-400 font-medium">Lengkapi data diri Anda dengan sebenar-benarnya untuk keperluan ijazah.</p>
            </div>

            <form action="{{ isset($is_editing) ? route('pendaftaran.update') : route('pendaftaran.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nama" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Nama Mahasiswa <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" name="nama" id="nama" value="{{ $pendaftaran->nama_mahasiswa ?? '' }}" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium" placeholder="Nama Lengkap Anda" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="nim" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">NIM <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <input type="text" name="nim" id="nim" value="{{ $pendaftaran->nim ?? '' }}" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium" placeholder="Nomor Induk Mahasiswa" required>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-2">
                        <label for="prodi" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Program Studi <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <select name="prodi" id="prodi" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 appearance-none" required>
                                <option value="" disabled selected>Pilih Program Studi</option>
                                <option value="Teknik Informatika" {{ ($pendaftaran->program_studi ?? '') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                <option value="Sistem Informasi" {{ ($pendaftaran->program_studi ?? '') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Manajemen" {{ ($pendaftaran->program_studi ?? '') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-2">
                        <label for="judul_skripsi" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Judul Skripsi <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 pt-4 flex items-start pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-book"></i>
                            </div>
                            <textarea name="judul_skripsi" id="judul_skripsi" rows="3" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium resize-none" placeholder="Tuliskan Judul Skripsi Anda" required>{{ $pendaftaran->judul_skripsi ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="pembimbing_1" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Pembimbing 1 <span class="text-red-500">*</span></label>
                        <input type="text" name="pembimbing_1" id="pembimbing_1" value="{{ $pendaftaran->pembimbing_1 ?? '' }}" class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium" placeholder="Dosen Pembimbing 1" required>
                    </div>

                    <div class="space-y-2">
                        <label for="pembimbing_2" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Pembimbing 2 <span class="text-red-500">*</span></label>
                        <input type="text" name="pembimbing_2" id="pembimbing_2" value="{{ $pendaftaran->pembimbing_2 ?? '' }}" class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium" placeholder="Dosen Pembimbing 2" required>
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-2">
                        <label for="email" class="text-xs font-black text-gray-500 uppercase tracking-widest ml-1">Email Aktif <span class="text-red-500">*</span></label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-at"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ $pendaftaran->email_aktif ?? '' }}" class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 placeholder:text-gray-300 placeholder:font-medium" placeholder="Email aktif for notifikasi" required>
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
                    <p class="text-xs font-medium text-gray-400">Pastikan data Anda sudah benar sebelum menekan tombol "Next".</p>
                    <button type="submit" class="w-full md:w-auto px-10 py-5 bg-[#0b3c39] text-white rounded-[2rem] font-black text-sm shadow-xl shadow-emerald-900/10 transition-all hover:bg-emerald-900 transform hover:-translate-y-1 flex items-center justify-center">
                        {{ isset($is_editing) ? 'PERBARUI DATA' : 'SIMPAN & LANJUTKAN' }} <i class="fas fa-arrow-right ml-3 bg-emerald-700 p-1.5 rounded-full text-[10px]"></i>
                    </button>
                    @if(isset($is_editing))
                        <a href="{{ route('pendaftaran') }}" class="text-xs font-black text-gray-400 uppercase tracking-widest hover:text-red-500 transition-all">Batal</a>
                    @endif
                </div>
            </form>
            @else
            <!-- View State for Registered Student -->
            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="flex-1 space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black tracking-widest uppercase mb-4">
                            <i class="fas fa-check-circle"></i> DATA TERDAFTAR
                        </div>
                        @if(session('success'))
                        <div class="mb-4 text-emerald-600 font-bold text-sm">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                        @endif
                        <h3 class="text-3xl font-black text-gray-800 leading-tight">Data Pendaftaran Anda Sudah Kami Terima</h3>
                        <p class="text-gray-500 font-medium mt-4">Silakan lanjutkan mengunduh berkas persyaratan dan melakukan verifikasi pembayaran.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nama Mahasiswa</p>
                            <p class="font-bold text-gray-700">{{ $pendaftaran->nama_mahasiswa }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">NIM</p>
                            <p class="font-bold text-gray-700">{{ $pendaftaran->nim }}</p>
                        </div>
                        <div class="col-span-1 md:col-span-2 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Program Studi</p>
                            <p class="font-bold text-gray-700">{{ $pendaftaran->program_studi }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('upload-berkas') }}" class="px-8 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-all">Upload Berkas <i class="fas fa-upload ml-2 text-[10px]"></i></a>
                        <a href="{{ route('pendaftaran.edit') }}" class="px-8 py-4 bg-white border border-gray-200 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:text-emerald-600 hover:border-emerald-200 transition-all">Edit Data</a>
                    </div>
                </div>

                <div class="w-full md:w-64">
                    <div class="bg-gray-50 p-6 rounded-[3rem] border border-gray-100 text-center relative">
                        <div class="bg-white p-4 rounded-3xl shadow-sm inline-block mb-4">
                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($pendaftaran->qr_token ?? $pendaftaran->nim) !!}
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">QR CODE PENDAFTARAN</p>
                        <p class="text-xs font-bold text-emerald-600">{{ $pendaftaran->qr_token ?? $pendaftaran->nim }}</p>
                        
                        <!-- Floating Badge -->
                        <div class="absolute -top-4 -right-4 w-12 h-12 bg-white rounded-2xl shadow-lg border border-gray-50 flex items-center justify-center text-[#0b3c39]">
                            <i class="fas fa-qrcode text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
