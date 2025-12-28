@extends('layouts.app')

@section('content')
<div class="space-y-10 pb-12">
    <!-- Stepper Header -->
    <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 py-4 mb-10">
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
        <div class="flex items-center space-x-4 w-full md:w-auto">
            <div class="w-10 h-10 {{ $isStep2Done ? 'bg-emerald-500 shadow-emerald-100' : 'bg-[#0b3c39]' }} text-white rounded-2xl flex items-center justify-center font-bold shadow-lg transition-all duration-500">
                @if($isStep2Done)
                    <i class="fas fa-check"></i>
                @else
                    <i class="fas fa-file-alt"></i>
                @endif
            </div>
            <div>
                <p class="text-[10px] font-black {{ $isStep2Done ? 'text-emerald-500' : 'text-[#0b3c39]' }} uppercase tracking-widest">Langkah 2</p>
                <h4 class="text-sm font-black {{ $isStep2Done ? 'text-emerald-600' : 'text-gray-800' }} uppercase">Dokumen</h4>
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

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Upload Dokumen Persyaratan</h2>
            <p class="text-gray-500 font-medium">Unggah seluruh berkas wajib untuk proses verifikasi wisuda.</p>
        </div>
        <div class="flex items-center space-x-2 bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-100 h-fit">
            <i class="fas fa-info-circle text-[#0b3c39]"></i>
            <span class="text-xs font-bold text-[#0b3c39] uppercase tracking-wider">Maksimal file 2MB (PDF/JPG)</span>
        </div>
    </div>

    @if($isStep2Done && !session('success'))
    <!-- Success State UI -->
    <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4">
            <span class="bg-emerald-100 text-emerald-600 text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest">Terkirim</span>
        </div>
        
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-24 h-24 bg-emerald-50 rounded-[2rem] flex items-center justify-center flex-shrink-0 animate-pulse">
                <i class="fas fa-check-double text-4xl text-emerald-500"></i>
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-black text-gray-800 mb-2">Berkas Berhasil Diverifikasi Sistem!</h3>
                <p class="text-gray-500 font-medium">Seluruh persyaratan dokumen telah kami terima. Admin akan melakukan pengecekan manual dalam waktu 1x24 jam.</p>
                
                <div class="mt-6 flex flex-wrap gap-3 justify-center md:justify-start">
                    <div class="flex items-center bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                        <i class="fas fa-file-pdf text-emerald-500 mr-2 text-xs"></i>
                        <span class="text-[10px] font-black text-gray-600 uppercase">Surat Pernyataan.pdf</span>
                    </div>
                    <div class="flex items-center bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                        <i class="fas fa-image text-emerald-500 mr-2 text-xs"></i>
                        <span class="text-[10px] font-black text-gray-600 uppercase">Foto Formal.jpg</span>
                    </div>
                    <div class="flex items-center bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                        <i class="fas fa-scroll text-emerald-500 mr-2 text-xs"></i>
                        <span class="text-[10px] font-black text-gray-600 uppercase">Transkrip.pdf</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        @if ($errors->any())
            <div class="mb-10 p-6 bg-red-50 border border-red-100 text-red-700 rounded-[2rem] flex items-start shadow-xl shadow-red-500/5 animate-shake">
                <div class="w-12 h-12 bg-red-500 text-white rounded-2xl flex items-center justify-center mr-5 flex-shrink-0 shadow-lg shadow-red-200">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-black text-sm uppercase tracking-tight mb-1">Peringatan: Dokumen Belum Lengkap</h4>
                    <p class="text-[11px] font-bold opacity-70 mb-3">Beberapa dokumen wajib belum diunggah atau format tidak sesuai:</p>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-[10px] font-black uppercase flex items-center">
                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-2"></span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        
        <!-- Photo Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formal Photo -->
            <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-gray-800 uppercase tracking-tighter">Pas Foto Formal</h3>
                    @if($pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_formal)
                        <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                    @else
                        <span class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-[#0b3c39] font-bold text-xs shadow-inner">01</span>
                    @endif
                </div>
                
                <div class="relative aspect-[3/4] max-w-[200px] mx-auto bg-gray-50 rounded-3xl border-4 border-dashed border-gray-100 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-[#0b3c39]/30">
                    <img id="preview_foto_formal" src="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_formal ? \Storage::url($pendaftaran->berkas->foto_formal) : '' }}" class="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_formal ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-0">
                    <div id="placeholder_foto_formal" class="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_formal ? 'hidden' : '' }} flex flex-col items-center">
                        <i class="fas fa-user-tie text-5xl text-gray-200 mb-4 transition-all group-hover:scale-110 group-hover:text-[#0b3c39]/10"></i>
                    </div>
                    <input type="file" name="foto_formal" class="hidden" id="foto_formal_input" onchange="previewImage(this, 'preview_foto_formal', 'placeholder_foto_formal', this.nextElementSibling)">
                    <button type="button" onclick="document.getElementById('foto_formal_input').click()" class="relative z-10 px-6 py-2.5 bg-gray-800/80 backdrop-blur-md text-white rounded-xl text-xs font-black shadow-lg hover:bg-black transition-all transform hover:scale-105 active:scale-95 uppercase">PILIH FILE</button>
                    <p class="relative z-10 mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 text-center">Latar belakang biru/merah</p>
                </div>
            </div>

            <!-- Free Photo -->
            <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-emerald-900/5 transition-all">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-gray-800 uppercase tracking-tighter">Foto Bebas (Ijazah)</h3>
                    @if($pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_bebas)
                        <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                    @else
                        <span class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-[#0b3c39] font-bold text-xs shadow-inner">02</span>
                    @endif
                </div>
                
                <div class="relative aspect-[3/4] max-w-[200px] mx-auto bg-gray-50 rounded-3xl border-4 border-dashed border-gray-100 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-[#0b3c39]/30">
                    <img id="preview_foto_bebas" src="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_bebas ? \Storage::url($pendaftaran->berkas->foto_bebas) : '' }}" class="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_bebas ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-0">
                    <div id="placeholder_foto_bebas" class="{{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->foto_bebas ? 'hidden' : '' }} flex flex-col items-center">
                        <i class="fas fa-camera text-5xl text-gray-200 mb-4 transition-all group-hover:scale-110 group-hover:text-[#0b3c39]/10"></i>
                    </div>
                    <input type="file" name="foto_bebas" class="hidden" id="foto_bebas_input" onchange="previewImage(this, 'preview_foto_bebas', 'placeholder_foto_bebas', this.nextElementSibling)">
                    <button type="button" onclick="document.getElementById('foto_bebas_input').click()" class="relative z-10 px-6 py-2.5 bg-gray-800/80 backdrop-blur-md text-white rounded-xl text-xs font-black shadow-lg hover:bg-black transition-all transform hover:scale-105 active:scale-95 uppercase">PILIH FILE</button>
                    <p class="relative z-10 mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 text-center">Foto kreatif / non-formal</p>
                </div>
            </div>
        </div>

        <!-- Documents Section -->
        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
            <h3 class="text-xl font-black text-gray-800 mb-10 border-l-8 border-[#0b3c39] pl-6">Berkas Tambahan</h3>
            
            @if(session('success'))
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-3xl flex items-center shadow-lg shadow-emerald-500/10 animate-fade-in-down">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-black text-sm uppercase">BERKAS BERHASIL TERUPLOAD!</p>
                        <p class="text-xs font-medium opacity-80 italic">Status pendaftaran Anda saat ini: MENUNGGU VERIFIKASI ADMIN.</p>
                    </div>
                </div>
            @endif

            <div class="space-y-8">
                <!-- File Item -->
                <div class="flex flex-col md:flex-row md:items-center p-6 bg-gray-50 rounded-3xl border border-gray-100 transition-all hover:bg-white hover:shadow-lg group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-[#0b3c39] shadow-sm flex-shrink-0 mb-4 md:mb-0">
                        @if($pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->surat_pernyataan)
                            <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                        @else
                            <i class="fas fa-file-pdf text-2xl"></i>
                        @endif
                    </div>
                    <div class="md:ml-6 flex-1">
                        <label for="surat_pernyataan" class="block text-sm font-black text-gray-800 uppercase tracking-tight">Surat Pernyataan Keaslian</label>
                        <p class="text-[10px] font-bold text-gray-400 mt-1">Format: PDF (Max. 2MB)</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <input type="file" name="surat_pernyataan" id="surat_pernyataan" class="hidden" onchange="this.nextElementSibling.innerText = 'FILE TERPILIH';">
                        <button type="button" onclick="this.previousElementSibling.click()" class="w-full md:w-auto px-6 py-3 bg-[#0b3c39] text-white rounded-xl text-xs font-black shadow-lg shadow-emerald-900/10 hover:bg-emerald-900 transition-all uppercase">
                            {{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->surat_pernyataan ? 'Update File' : 'Upload File' }}
                        </button>
                    </div>
                </div>

                <!-- File Item -->
                <div class="flex flex-col md:flex-row md:items-center p-6 bg-gray-50 rounded-3xl border border-gray-100 transition-all hover:bg-white hover:shadow-lg group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-[#0b3c39] shadow-sm flex-shrink-0 mb-4 md:mb-0">
                        @if($pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->transkip_nilai)
                            <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                        @else
                            <i class="fas fa-scroll text-2xl"></i>
                        @endif
                    </div>
                    <div class="md:ml-6 flex-1">
                        <label for="transkrip_nilai" class="block text-sm font-black text-gray-800 uppercase tracking-tight">Transkrip Nilai Akhir</label>
                        <p class="text-[10px] font-bold text-gray-400 mt-1">Format: PDF (Max. 2MB)</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <input type="file" name="transkip_nilai" id="transkrip_nilai" class="hidden" onchange="this.nextElementSibling.innerText = 'FILE TERPILIH';">
                        <button type="button" onclick="this.previousElementSibling.click()" class="w-full md:w-auto px-6 py-3 bg-[#0b3c39] text-white rounded-xl text-xs font-black shadow-lg shadow-emerald-900/10 hover:bg-emerald-900 transition-all uppercase">
                            {{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->transkip_nilai ? 'Update File' : 'Upload File' }}
                        </button>
                    </div>
                </div>

                <!-- File Item -->
                <div class="flex flex-col md:flex-row md:items-center p-6 bg-gray-50 rounded-3xl border border-gray-100 transition-all hover:bg-white hover:shadow-lg group">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-[#0b3c39] shadow-sm flex-shrink-0 mb-4 md:mb-0">
                        @if($pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->krs_terpenuhi)
                            <i class="fas fa-check-circle text-emerald-500 text-2xl"></i>
                        @else
                            <i class="fas fa-file-powerpoint text-2xl"></i>
                        @endif
                    </div>
                    <div class="md:ml-6 flex-1">
                        <label for="krs_terpenuhi" class="block text-sm font-black text-gray-800 uppercase tracking-tight">Slide Presentasi Skripsi</label>
                        <p class="text-[10px] font-bold text-gray-400 mt-1">Format: PPTX/PDF (Max. 5MB)</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <input type="file" name="krs_terpenuhi" id="krs_terpenuhi" class="hidden" onchange="this.nextElementSibling.innerText = 'FILE TERPILIH';">
                        <button type="button" onclick="this.previousElementSibling.click()" class="w-full md:w-auto px-6 py-3 bg-[#0b3c39] text-white rounded-xl text-xs font-black shadow-lg shadow-emerald-900/10 hover:bg-emerald-900 transition-all uppercase">
                            {{ $pendaftaran && $pendaftaran->berkas && $pendaftaran->berkas->krs_terpenuhi ? 'Update File' : 'Upload File' }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full md:w-auto px-12 py-5 {{ $isStep2Done ? 'bg-emerald-500' : 'bg-amber-400' }} {{ $isStep2Done ? 'text-white' : 'text-amber-950' }} rounded-2xl font-black text-sm shadow-xl transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center">
                    <i class="fas {{ $isStep2Done ? 'fa-sync-alt' : 'fa-cloud-upload-alt' }} mr-3"></i> 
                    {{ $isStep2Done ? 'UPDATE & KIRIM ULANG' : 'SIMPAN & VERIFIKASI SEKARANG' }}
                </button>
            </div>
        </div>
    </form>
    <script>
        function previewImage(input, previewId, placeholderId, button) {
            const preview = document.getElementById(previewId);
            const placeholder = document.getElementById(placeholderId);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    if(button) button.innerText = 'FILE TERPILIH';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</div>
@endsection
