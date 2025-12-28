@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-12" x-data="{ filter: 'all' }">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 bg-emerald-100 rounded-3xl flex items-center justify-center text-[#0b3c39] shadow-inner">
                <i class="fas fa-bullhorn text-2xl"></i>
            </div>
            <div>
                <h2 class="text-3xl font-black text-gray-800 tracking-tight">Pusat Informasi</h2>
                <p class="text-gray-500 font-medium">Update terbaru seputar agenda Wisuda 2025</p>
            </div>
        </div>
        <div class="flex bg-white p-1.5 rounded-2xl shadow-sm border border-gray-100">
            <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-[#0b3c39] text-white shadow-lg shadow-emerald-900/20' : 'text-gray-500 hover:text-[#0b3c39]'" class="px-6 py-2 rounded-xl font-bold text-sm transition-all duration-300">Semua</button>
            <button @click="filter = 'penting'" :class="filter === 'penting' ? 'bg-[#0b3c39] text-white shadow-lg shadow-emerald-900/20' : 'text-gray-500 hover:text-[#0b3c39]'" class="px-6 py-2 rounded-xl font-bold text-sm transition-all duration-300">Penting</button>
            <button @click="filter = 'agenda'" :class="filter === 'agenda' ? 'bg-[#0b3c39] text-white shadow-lg shadow-emerald-900/20' : 'text-gray-500 hover:text-[#0b3c39]'" class="px-6 py-2 rounded-xl font-bold text-sm transition-all duration-300">Agenda</button>
        </div>
    </div>

    @php
        $featured = $announcements->where('type', 'penting')->first() ?? $announcements->first();
        $others = $announcements->where('id', '!=', optional($featured)->id);
    @endphp

    @if($featured)
    <!-- Featured Announcement -->
    <div x-show="filter === 'all' || filter === '{{ $featured->type }}'" x-transition class="group relative bg-[#0b3c39] rounded-[3.5rem] p-8 md:p-14 text-white overflow-hidden shadow-2xl shadow-emerald-900/20 transform transition-all hover:scale-[1.01]">
        <div class="relative z-20 flex flex-col md:flex-row gap-12 items-center">
            <div class="flex-1 space-y-8">
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 bg-red-500 text-white rounded-full text-[10px] font-black tracking-widest uppercase shadow-lg shadow-red-500/30">{{ strtoupper($featured->type) }}</span>
                    <span class="text-white/40 text-[10px] font-black tracking-widest uppercase">{{ $featured->created_at->format('d F Y') }}</span>
                </div>
                <h3 class="text-4xl md:text-5xl font-black leading-tight tracking-tighter">{{ $featured->title }}</h3>
                <p class="text-white/70 text-lg font-medium leading-relaxed max-w-2xl">{{ $featured->content }}</p>
                
                @if($featured->date || $featured->location || $featured->time)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                    @if($featured->date)
                    <div class="p-5 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2">TANGGAL</p>
                        <p class="font-bold">{{ \Carbon\Carbon::parse($featured->date)->format('d M Y') }}</p>
                    </div>
                    @endif
                    @if($featured->time)
                    <div class="p-5 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2">WAKTU</p>
                        <p class="font-bold">{{ $featured->time }}</p>
                    </div>
                    @endif
                    @if($featured->location)
                    <div class="col-span-2 md:col-span-1 p-5 bg-white/5 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2">LOKASI</p>
                        <p class="font-bold uppercase">{{ $featured->location }}</p>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="w-full md:w-80 group-hover:rotate-2 transition-transform">
                <div class="aspect-square bg-gradient-to-br from-emerald-800 to-emerald-950 rounded-[3rem] border-8 border-white/10 flex items-center justify-center relative overflow-hidden">
                    <i class="fas fa-graduation-cap text-8xl text-white/10 absolute -right-4 -bottom-4 rotate-12"></i>
                    <i class="fas fa-scroll text-8xl text-emerald-400/40"></i>
                </div>
            </div>
        </div>
        
        <!-- Decorative Ornaments -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-emerald-400/5 rounded-full blur-3xl"></div>
    </div>

    <!-- More Announcements Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($others as $item)
        <div x-show="filter === 'all' || filter === '{{ $item->type }}'" x-transition class="group bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 transition-all hover:shadow-xl hover:shadow-emerald-900/5 hover:-translate-y-2">
            <div class="w-14 h-14 {{ $item->type == 'penting' ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-blue-600' }} rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#0b3c39] group-hover:text-white transition-all">
                <i class="fas {{ $item->type == 'agenda' ? 'fa-calendar-alt' : 'fa-bullhorn' }} text-2xl"></i>
            </div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $item->type }}</span>
            <h4 class="text-xl font-black text-gray-800 mt-2 mb-4 leading-tight">{{ $item->title }}</h4>
            <p class="text-gray-500 text-sm font-medium mb-8 line-clamp-3">{{ $item->content }}</p>
            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                <span class="text-[10px] font-black text-gray-400 uppercase">{{ $item->created_at->format('d M Y') }}</span>
                <button class="text-[#0b3c39] font-black text-xs uppercase tracking-widest flex items-center gap-2 group-hover:gap-3 transition-all">Baca <i class="fas fa-arrow-right text-[10px]"></i></button>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Placeholder if no announcements -->
    <div class="bg-white p-20 rounded-[4rem] text-center border-2 border-dashed border-gray-100">
        <div class="w-24 h-24 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-8 text-gray-300">
            <i class="fas fa-bullhorn text-4xl"></i>
        </div>
        <h3 class="text-2xl font-black text-gray-800">Belum Ada Pengumuman</h3>
        <p class="text-gray-400 font-medium max-w-sm mx-auto mt-4">Saat ini belum ada pengumuman terbaru yang diterbitkan oleh panitia wisuda.</p>
    </div>
    @endif
    
    <!-- Empty State for Filter -->
    <div x-show="filter !== 'all' && $el.querySelectorAll('.grid > div[style*=\'display: none\']').length === {{ $others->count() }} && (filter !== '{{ optional($featured)->type }}' || !{{ $featured ? 'true' : 'false' }})" style="display: none;" class="text-center py-20">
        <div class="inline-flex w-16 h-16 bg-gray-50 rounded-2xl items-center justify-center text-gray-300 mb-4">
            <i class="fas fa-search text-2xl"></i>
        </div>
        <p class="text-gray-400 font-bold text-sm">Tidak ada pengumuman untuk kategori ini.</p>
    </div>
</div>
<!-- Alpine JS -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection