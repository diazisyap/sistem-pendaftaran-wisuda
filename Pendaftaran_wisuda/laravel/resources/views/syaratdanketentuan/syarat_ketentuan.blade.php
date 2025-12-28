@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-10 pb-12">
    <!-- Icon Header -->
    <div class="text-center space-y-4">
        <div class="inline-flex w-20 h-20 bg-amber-100 rounded-[2rem] items-center justify-center text-amber-600 shadow-lg shadow-amber-900/5 transition-transform hover:rotate-12">
            <i class="fas fa-scroll text-3xl"></i>
        </div>
        <h2 class="text-3xl font-black text-gray-800 tracking-tight uppercase">Syarat & Ketentuan Wisuda</h2>
        <p class="text-gray-400 font-medium italic">Harap baca dengan teliti sebelum melanjutkan proses pendaftaran.</p>
    </div>

    <!-- Content Sections -->
    <div class="bg-white p-10 md:p-14 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden">
        <!-- Floating Numbers Background -->
        <span class="absolute top-20 right-10 text-[20rem] font-black text-gray-50/50 leading-none select-none pointer-events-none">01</span>

        <div class="relative z-10 space-y-12">
            <!-- Section 1 -->
            <section class="space-y-6">
                <div class="flex items-center space-x-4">
                    <span class="flex-shrink-0 w-8 h-8 bg-[#0b3c39] text-white rounded-lg flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-100">1</span>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Ketentuan Umum Pendaftar</h3>
                </div>
                <div class="ml-12 space-y-4">
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-all hover:bg-white hover:shadow-md">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <p class="text-sm font-bold text-gray-600 leading-relaxed">Mahasiswa hanya diperbolehkan melakukan pendaftaran wisuda satu kali per periode.</p>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-all hover:bg-white hover:shadow-md">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <p class="text-sm font-bold text-gray-600 leading-relaxed">Seluruh data yang diinputkan harus valid dan sesuai dengan Forlap DIKTI / Data Akademik Kampus.</p>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 transition-all hover:bg-white hover:shadow-md">
                        <i class="fas fa-check-circle text-emerald-500 mt-1"></i>
                        <p class="text-sm font-bold text-gray-600 leading-relaxed">Status pendaftaran dianggap sah apabila seluruh berkas telah diverifikasi oleh Admin & Bagian Keuangan.</p>
                    </div>
                </div>
            </section>

            <!-- Section 2 -->
            <section class="space-y-6">
                <div class="flex items-center space-x-4">
                    <span class="flex-shrink-0 w-8 h-8 bg-[#0b3c39] text-white rounded-lg flex items-center justify-center font-black text-sm shadow-lg shadow-emerald-100">2</span>
                    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Berkas Wajib Unggah</h3>
                </div>
                <div class="ml-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex flex-col items-center text-center">
                        <i class="fas fa-file-contract text-2xl text-[#0b3c39] mb-3"></i>
                        <p class="text-xs font-black text-[#0b3c39] uppercase tracking-widest">Surat Pernyataan</p>
                    </div>
                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex flex-col items-center text-center">
                        <i class="fas fa-camera-retro text-2xl text-[#0b3c39] mb-3"></i>
                        <p class="text-xs font-black text-[#0b3c39] uppercase tracking-widest">Pas Foto Formal</p>
                    </div>
                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex flex-col items-center text-center">
                        <i class="fas fa-certificate text-2xl text-[#0b3c39] mb-3"></i>
                        <p class="text-xs font-black text-[#0b3c39] uppercase tracking-widest">Transkrip Nilai</p>
                    </div>
                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex flex-col items-center text-center">
                        <i class="fas fa-receipt text-2xl text-[#0b3c39] mb-3"></i>
                        <p class="text-xs font-black text-[#0b3c39] uppercase tracking-widest">Bukti Pembayaran</p>
                    </div>
                </div>
            </section>

            <!-- Agreement Section -->
            <div class="pt-10 border-t border-gray-100">
                <label class="flex items-center space-x-4 cursor-pointer group">
                    <div class="relative">
                        <input type="checkbox" id="setuju" class="peer hidden">
                        <div class="w-8 h-8 bg-gray-100 border-2 border-gray-200 rounded-xl peer-checked:bg-[#0b3c39] peer-checked:border-[#0b3c39] transition-all flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                        </div>
                    </div>
                    <span class="text-sm font-bold text-gray-600 group-hover:text-gray-800 transition-colors uppercase tracking-tight italic">Saya menyatakan telah membaca, memahami, dan menyetujui seluruh ketentuan di atas.</span>
                </label>
            </div>
        </div>
    </div>
</div>
@endsection