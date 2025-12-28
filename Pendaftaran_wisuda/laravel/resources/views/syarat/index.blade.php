@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:text-[#0b3c39] transition-all shadow-sm">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h2 class="text-2xl font-black text-gray-800 tracking-tight">Persyaratan Wisuda</h2>
    </div>

    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
        <h3 class="text-xl font-black text-gray-800 mb-6">Dokumen yang Harus Disiapkan</h3>
        
        <div class="space-y-6">
            <div class="flex items-start gap-4 p-6 bg-emerald-50 rounded-2xl border border-emerald-100">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-camera"></i>
                </div>
                <div>
                    <h4 class="font-black text-gray-800 mb-2">1. Pas Foto Formal (3x4)</h4>
                    <p class="text-sm text-gray-600 font-medium">Background merah, berpakaian formal (kemeja putih), ukuran 3x4 cm. Format JPG/PNG, maksimal 2MB.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 bg-blue-50 rounded-2xl border border-blue-100">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <h4 class="font-black text-gray-800 mb-2">2. Pas Foto Bebas</h4>
                    <p class="text-sm text-gray-600 font-medium">Foto close-up terbaru, background bebas. Format JPG/PNG, maksimal 2MB.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 bg-amber-50 rounded-2xl border border-amber-100">
                <div class="w-10 h-10 bg-amber-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-file-signature"></i>
                </div>
                <div>
                    <h4 class="font-black text-gray-800 mb-2">3. Surat Pernyataan</h4>
                    <p class="text-sm text-gray-600 font-medium">Surat pernyataan bermaterai yang sudah ditandatangani. Format PDF, maksimal 2MB.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 bg-purple-50 rounded-2xl border border-purple-100">
                <div class="w-10 h-10 bg-purple-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h4 class="font-black text-gray-800 mb-2">4. Transkrip Nilai Terakhir</h4>
                    <p class="text-sm text-gray-600 font-medium">Transkrip nilai semester terakhir yang sudah dilegalisir. Format PDF, maksimal 2MB.</p>
                </div>
            </div>

            <div class="flex items-start gap-4 p-6 bg-pink-50 rounded-2xl border border-pink-100">
                <div class="w-10 h-10 bg-pink-600 rounded-xl flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h4 class="font-black text-gray-800 mb-2">5. Bukti KRS Terpenuhi</h4>
                    <p class="text-sm text-gray-600 font-medium">Bukti bahwa seluruh KRS telah terpenuhi dari akademik. Format PDF, maksimal 2MB.</p>
                </div>
            </div>
        </div>

        <div class="mt-10 p-6 bg-red-50 rounded-2xl border border-red-100">
            <div class="flex items-start gap-3">
                <i class="fas fa-exclamation-triangle text-red-600 mt-1"></i>
                <div>
                    <h4 class="font-black text-red-800 mb-2">Catatan Penting:</h4>
                    <ul class="text-sm text-red-700 font-medium space-y-1 list-disc list-inside">
                        <li>Pastikan semua dokumen dalam kondisi jelas dan terbaca</li>
                        <li>Ukuran file maksimal 2MB per dokumen</li>
                        <li>Format yang diterima: JPG, PNG untuk foto dan PDF untuk dokumen</li>
                        <li>Dokumen yang tidak sesuai akan diminta revisi oleh admin</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('pendaftaran') }}" class="px-10 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-emerald-900/20 hover:scale-105 transition-all">
                Mulai Pendaftaran <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
@endsection
