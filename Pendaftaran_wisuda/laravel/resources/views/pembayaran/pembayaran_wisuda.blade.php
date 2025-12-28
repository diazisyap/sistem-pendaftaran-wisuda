```
@extends('layouts.app')

@section('content')
<div class="space-y-8" x-data="{ activeMethod: null }">
    <!-- Progress Steps -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center relative z-10 max-w-4xl mx-auto">
            <!-- Step 1: Input Identitas (Done) -->
            <div class="flex items-center space-x-4 z-10 bg-white pr-4">
                <div class="w-12 h-12 bg-emerald-400 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                    <i class="fas fa-check text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Langkah 1</p>
                    <h4 class="text-sm font-bold text-gray-800">INPUT IDENTITAS</h4>
                </div>
            </div>

            <!-- Connector Image/Line -->
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-emerald-100 -z-0"></div>
            
            <!-- Step 2: Dokumen (Done) -->
            <div class="flex items-center space-x-4 z-10 bg-white px-4">
                <div class="w-12 h-12 bg-emerald-400 rounded-full flex items-center justify-center shadow-lg shadow-emerald-200">
                    <i class="fas fa-check text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Langkah 2</p>
                    <h4 class="text-sm font-bold text-gray-800">DOKUMEN</h4>
                </div>
            </div>

            <!-- Step 3: Pembayaran (Active) -->
            <div class="flex items-center space-x-4 z-10 bg-white pl-4">
                <div class="w-12 h-12 bg-[#0b3c39] rounded-full flex items-center justify-center shadow-lg shadow-emerald-900/20">
                    <i class="fas fa-wallet text-white text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-[#0b3c39] uppercase tracking-widest">Langkah 3</p>
                    <h4 class="text-sm font-bold text-gray-800">PEMBAYARAN</h4>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center mb-6">
        <i class="fas fa-check-circle text-emerald-500 mr-3 text-xl"></i>
        <span class="text-emerald-700 font-bold text-sm">{{ session('success') }}</span>
    </div>
    @endif
    
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6">
        <ul class="list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Billing Information (Left Column) -->
        <div class="lg:col-span-7 space-y-8">
            <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <!-- Decorative Icon -->
                <i class="fas fa-file-invoice-dollar absolute -bottom-10 -right-10 text-[12rem] text-gray-50 opacity-50 -rotate-12"></i>

                <div class="relative z-20">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-[#0b3c39] flex-shrink-0">
                            <i class="fas fa-receipt text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Rincian Tagihan Wisuda</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Standard Items -->
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center justify-between transition-all hover:bg-white hover:shadow-md">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Biaya Pendaftaran</p>
                                <h4 class="text-sm font-bold text-gray-800">Tagihan Administrasi</h4>
                            </div>
                            <span class="text-base font-black text-[#0b3c39]">Rp 500.000</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center justify-between transition-all hover:bg-white hover:shadow-md">
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Atribut Wisuda</p>
                                <h4 class="text-sm font-bold text-gray-800">Toga & Kelengkapan</h4>
                            </div>
                            <span class="text-base font-black text-[#0b3c39]">Rp 250.000</span>
                        </div>

                        <!-- Extra Seats Item (Dynamic) -->
                        @if($pendaftaran && $pendaftaran->jumlah_kursi_tambahan > 0)
                        <div class="bg-indigo-50 p-4 rounded-2xl border border-indigo-100 flex items-center justify-between transition-all hover:bg-white hover:shadow-md">
                            <div>
                                <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Tambahan</p>
                                <h4 class="text-sm font-bold text-indigo-900">Kursi Tamu ({{ $pendaftaran->jumlah_kursi_tambahan }}x)</h4>
                            </div>
                            <span class="text-base font-black text-indigo-600">Rp {{ number_format($pendaftaran->jumlah_kursi_tambahan * 150000, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @php
                            $total = 750000 + ($pendaftaran ? $pendaftaran->jumlah_kursi_tambahan * 150000 : 0);
                        @endphp

                        <div class="pt-4 border-t-2 border-dashed border-gray-100 flex items-center justify-between">
                            <h4 class="text-xs font-black text-gray-400 uppercase">Total Pembayaran</h4>
                            <span class="text-2xl font-black text-amber-500">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="#payment-form-section" onclick="document.getElementById('payment-form-section').scrollIntoView({behavior: 'smooth'}); return false;" class="w-full py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs shadow-xl shadow-emerald-900/10 transition-all hover:bg-emerald-900 transform hover:-translate-y-1 flex justify-center items-center group cursor-pointer block text-center no-underline">
                            <span>AKTIFKAN PEMBAYARAN SEKARANG</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Guide, Upload, and Seat Form -->
        <div id="payment-form-section" class="lg:col-span-5 space-y-8">
            
            <!-- Payment Guide -->
            <div class="bg-[#0b3c39] p-8 rounded-[2.5rem] shadow-xl shadow-emerald-900/10 text-white relative overflow-hidden">
                 <!-- Decorative Wave -->
                 <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full fill-white">
                        <path d="M0 50 Q 25 25, 50 50 Q 75 75, 100 50 L 100 100 L 0 100 Z" />
                    </svg>
                 </div>

                 <div class="relative z-10">
                    <h4 class="text-lg font-black mb-6 flex items-center">
                        <i class="fas fa-shield-alt mr-3 text-emerald-400"></i>
                        METODE PEMBAYARAN
                    </h4>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <span class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">1</span>
                            <span class="text-xs font-medium text-white/80 leading-relaxed">Pastikan total tagihan sesuai dengan rincian di samping <b>(Rp {{ number_format($total, 0, ',', '.') }})</b>.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">2</span>
                            <span class="text-xs font-medium text-white/80 leading-relaxed">Pilih salah satu metode pembayaran di bawah ini.</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center text-[10px] font-black flex-shrink-0 mt-0.5">3</span>
                            <span class="text-xs font-medium text-white/80 leading-relaxed">Simpan & unggah bukti pembayaran.</span>
                        </li>
                    </ul>
                    <div class="mt-8 pt-8 border-t border-white/10">
                        <p class="text-[10px] font-black uppercase tracking-widest text-white/60 mb-4">Metode Pembayaran Tersedia</p>
                        <div class="grid grid-cols-3 gap-3">
                            <button @click="activeMethod = 'finpay'" class="bg-white/5 rounded-xl p-3 flex flex-col items-center justify-center border border-white/10 hover:bg-white/10 transition-all cursor-pointer group w-full">
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white mb-2 group-hover:bg-white group-hover:text-[#0b3c39] transition-colors">
                                    <i class="fas fa-university text-xs"></i>
                                </div>
                                <span class="text-[8px] font-black tracking-widest uppercase text-white/80">Finpay</span>
                            </button>
                            <button @click="activeMethod = 'shopeepay'" class="bg-white/5 rounded-xl p-3 flex flex-col items-center justify-center border border-white/10 hover:bg-white/10 transition-all cursor-pointer group w-full">
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white mb-2 group-hover:bg-white group-hover:text-[#0b3c39] transition-colors">
                                    <i class="fas fa-shopping-bag text-xs"></i>
                                </div>
                                <span class="text-[8px] font-black tracking-widest uppercase text-white/80">Shopee</span>
                            </button>
                            <button @click="activeMethod = 'gopay'" class="bg-white/5 rounded-xl p-3 flex flex-col items-center justify-center border border-white/10 hover:bg-white/10 transition-all cursor-pointer group w-full">
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white mb-2 group-hover:bg-white group-hover:text-[#0b3c39] transition-colors">
                                    <i class="fas fa-wallet text-xs"></i>
                                </div>
                                <span class="text-[8px] font-black tracking-widest uppercase text-white/80">GoPay</span>
                            </button>
                        </div>
                    </div>
            </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center text-amber-500">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <h4 class="text-sm font-black text-gray-800 uppercase tracking-tight">Konfirmasi Pembayaran</h4>
                </div>

                @if($pendaftaran && $pendaftaran->status_pembayaran == 'menunggu_verifikasi')
                     <div class="bg-blue-50 p-4 rounded-xl text-center border border-blue-100">
                        <i class="fas fa-clock text-blue-500 text-2xl mb-2"></i>
                        <p class="text-xs font-bold text-blue-700">Pembayaran sedang diverifikasi.</p>
                        <p class="text-[10px] text-blue-500">Mohon tunggu admin memvalidasi bukti transfer Anda.</p>
                     </div>
                @elseif($pendaftaran && $pendaftaran->status_pembayaran == 'lunas')
                    <div class="bg-green-50 p-4 rounded-xl text-center border border-green-100">
                        <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                        <p class="text-xs font-bold text-green-700">Pembayaran Lunas.</p>
                        <p class="text-[10px] text-green-500">Terima kasih telah melakukan pembayaran.</p>
                     </div>
                @else
                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Unggah Bukti Transfer</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#0b3c39] transition-colors">
                                <i class="fas fa-image"></i>
                            </div>
                            <input type="file" name="bukti_pembayaran" required class="w-full pl-11 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#0b3c39]/20 transition-all font-bold text-gray-700 text-xs">
                        </div>
                        <p class="text-[10px] text-gray-400 pl-1">*Format: JPG/PNG, Max 2MB</p>
                    </div>
                    <button type="submit" class="w-full py-4 bg-amber-400 text-amber-950 rounded-2xl font-black text-xs shadow-lg shadow-amber-100 hover:bg-amber-500 transition-all cursor-pointer">
                        KIRIM BUKTI PEMBAYARAN
                    </button>
                 </form>
                 @endif
            </div>

            <!-- Extra Seat Form Section (Standard) -->
             @if(!$pendaftaran || $pendaftaran->status_pembayaran != 'lunas')
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <h4 class="text-sm font-black text-gray-800 uppercase tracking-tight">Tambah Kursi Tamu</h4>
                </div>
                
                <p class="text-xs text-gray-500 font-medium mb-6 leading-relaxed">
                    Kuota kursi tambahan terbatas. Harga per kursi <b>Rp 150.000</b>. Penambahan kursi akan otomatis menambah total tagihan Anda.
                </p>

                <form action="{{ route('pembayaran.kursi') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Jumlah Kursi Tambahan</label>
                        <input type="number" name="jumlah_kursi" min="0" max="5" value="{{ $pendaftaran ? $pendaftaran->jumlah_kursi_tambahan : 0 }}" class="w-full px-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500/20 font-bold text-gray-700 text-sm">
                    </div>
                    <button type="submit" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all cursor-pointer">
                        UPDATE TAGIHAN
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
    
    <!-- Payment Modal -->
    <div x-show="activeMethod" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center px-4">
        <!-- Backdrop -->
        <div x-show="activeMethod" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="activeMethod = null" class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div x-show="activeMethod" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-4" class="bg-white rounded-[2rem] shadow-2xl w-full max-w-sm relative z-50 overflow-hidden">
            <!-- Header -->
            <div class="bg-[#0b3c39] p-6 text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                   <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full fill-white">
                       <path d="M0 50 Q 25 25, 50 50 Q 75 75, 100 50 L 100 100 L 0 100 Z" />
                   </svg>
                </div>
                <h3 class="text-lg font-black uppercase tracking-widest relative z-10" x-text="activeMethod === 'finpay' ? 'Kode Bayar Finpay' : (activeMethod === 'shopeepay' ? 'Scan ShopeePay' : 'Scan GoPay')"></h3>
            </div>
            
            <!-- Body -->
            <div class="p-8 text-center space-y-6">
                <!-- Dynamic Content based on Active Method -->
                <div x-show="activeMethod === 'finpay'">
                    <p class="text-xs text-gray-500 font-medium mb-4">Gunakan kode pembayaran berikut di ATM atau Mobile Banking:</p>
                    <div class="bg-gray-100 p-4 rounded-xl border border-gray-200">
                        <span class="text-2xl font-black text-gray-800 tracking-widest textSelect-all">1902 4451 0001</span>
                    </div>
                </div>

                <div x-show="activeMethod === 'shopeepay' || activeMethod === 'gopay'">
                    <p class="text-xs text-gray-500 font-medium mb-4">Scan QRIS berikut menggunakan aplikasi:</p>
                    <div class="bg-white p-4 rounded-xl border-2 border-dashed border-gray-200 inline-block">
                        <!-- Mock QR Code Placeholder -->
                        <div class="w-32 h-32 bg-gray-800 flex items-center justify-center text-white rounded-lg">
                            <i class="fas fa-qrcode text-4xl"></i>
                        </div>
                    </div>
                </div>

                <p class="text-[10px] text-gray-400 leading-relaxed">
                    Setelah melakukan pembayaran, jangan lupa screenshot bukti transaksi dan unggah pada formulir konfirmasi.
                </p>
                
                <button @click="activeMethod = null" class="w-full py-3 bg-gray-100 text-gray-800 rounded-xl font-bold text-xs hover:bg-gray-200 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
```
