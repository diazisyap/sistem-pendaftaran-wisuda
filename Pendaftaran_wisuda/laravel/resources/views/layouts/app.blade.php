<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Pendaftaran Wisuda' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar {
            background-color: #0b3c39;
        }
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid #fff;
        }
        .sidebar-link:not(.active) {
            color: rgba(255, 255, 255, 0.7);
        }
        .sidebar-link:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.4s ease-in-out;
        }
    </style>
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen sidebar shadow-xl flex flex-col fixed left-0 top-0 z-20">
        <div class="p-8 mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <h4 class="font-black text-white text-lg tracking-tighter uppercase">WISUDA</h4>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            @php $current_route = request()->segment(1) ?: 'dashboard'; @endphp
            
            <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'dashboard' ? 'active' : '' }}">
                <i class="fas fa-th-large w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Dashboard</span>
            </a>
            <a href="{{ route('pendaftaran') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'pendaftaran' ? 'active' : '' }}">
                <i class="fas fa-graduation-cap w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Pendaftaran Wisuda</span>
            </a>
            <a href="{{ route('upload-berkas') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'upload-berkas' ? 'active' : '' }}">
                <i class="fas fa-file-upload w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Upload Dokumen</span>
            </a>
            <a href="{{ route('pembayaran') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'pembayaran' ? 'active' : '' }}">
                <i class="fas fa-wallet w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Pembayaran</span>
            </a>
            <a href="{{ route('kehadiran') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'kehadiran' ? 'active' : '' }}">
                <i class="fas fa-calendar-check w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Kehadiran</span>
            </a>
            <a href="{{ route('pengumuman') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'pengumuman' ? 'active' : '' }}">
                <i class="fas fa-bullhorn w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Pengumuman</span>
            </a>
            <a href="{{ route('syarat') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'syarat' ? 'active' : '' }}">
                <i class="fas fa-scroll w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Syarat & Ketentuan</span>
            </a>
            <a href="{{ route('student.settings') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ $current_route == 'pengaturan' ? 'active' : '' }}">
                <i class="fas fa-cog w-5 text-center mr-3"></i>
                <span class="font-bold text-sm">Pengaturan</span>
            </a>
        </nav>

        <div class="p-4 mt-auto border-t border-white/10">
            <a href="{{ url('/logout') }}" class="flex items-center px-4 py-3 bg-amber-400 text-amber-950 rounded-xl font-black text-sm transition-all hover:bg-amber-500 justify-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Log out
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen">
        <!-- Top Navbar -->
        <!-- Top Navbar -->
        <!-- Top Navbar -->
        <header class="sticky top-0 z-50 px-8 py-4 flex items-center justify-between transition-all duration-300 bg-white/80 backdrop-blur-xl border-b border-gray-100/50 supports-[backdrop-filter]:bg-white/60">
            <h1 class="text-xl font-extrabold text-[#0b3c39] uppercase tracking-wider">{{ $title ?? 'Sistem Wisuda' }}</h1>
            
            <div class="flex items-center space-x-6">
                <!-- Notifications Dropdown -->
                @php
                    $user = Auth::user();
                    $pendaftaran = $user->pendaftaran;
                    $berkas = $pendaftaran ? $pendaftaran->berkas : null;
                    $notifikasi_items = [];

                    // 1. Dokumen Belum Upload
                    if ($pendaftaran && (!$berkas || !$berkas->foto_formal || !$berkas->foto_bebas || !$berkas->surat_pernyataan || !$berkas->transkip_nilai || !$berkas->krs_terpenuhi)) {
                        $notifikasi_items[] = [
                            'icon' => 'fa-file-upload',
                            'color' => 'amber',
                            'title' => 'Lengkapi Dokumen',
                            'message' => 'Beberapa dokumen persyaratan belum diunggah. Segera lengkapi untuk melanjutkan.',
                            'url' => route('upload-berkas'),
                            'action' => 'Upload Sekarang'
                        ];
                    }

                    // 2. Jadwal Wisuda & Ijazah
                    $sesi_wisuda = \App\Models\SesiWisuda::where('status_sesi', 'aktif')->first();
                    if ($sesi_wisuda) {
                        $notifikasi_items[] = [
                            'icon' => 'fa-calendar-alt',
                            'color' => 'blue',
                            'title' => 'Jadwal Wisuda',
                            'message' => 'Sesi: ' . $sesi_wisuda->nama_sesi . ' pada ' . \Carbon\Carbon::parse($sesi_wisuda->tanggal)->format('d M Y'),
                            'url' => route('pengumuman'),
                            'action' => null
                        ];
                        
                        // Mock Jadwal Ambil Ijazah
                        $tgl_wisuda = \Carbon\Carbon::parse($sesi_wisuda->tanggal);
                        $tgl_ijazah = $tgl_wisuda->copy()->addDays(7);
                        $notifikasi_items[] = [
                            'icon' => 'fa-scroll',
                            'color' => 'emerald',
                            'title' => 'Jadwal Ambil Ijazah',
                            'message' => 'Estimasi pengambilan ijazah mulai ' . $tgl_ijazah->format('d M Y') . '.',
                            'url' => '#', 
                            'action' => null
                        ];
                    } else {
                         $notifikasi_items[] = [
                            'icon' => 'fa-calendar-times',
                            'color' => 'gray',
                            'title' => 'Jadwal Wisuda',
                            'message' => 'Belum ada jadwal wisuda yang aktif saat ini.',
                            'url' => '#',
                            'action' => null
                        ];
                    }

                    // 3. System Status Notifications
                    if ($pendaftaran) {
                        if ($pendaftaran->status_pendaftaran == 'verifikasi_berkas') {
                             $notifikasi_items[] = [
                                'icon' => 'fa-spinner',
                                'color' => 'indigo',
                                'title' => 'Verifikasi Berkas',
                                'message' => 'Berkas Anda sedang dalam proses verifikasi oleh admin.',
                                'url' => route('dashboard'),
                                'action' => null
                            ];
                        } elseif ($pendaftaran->status_pendaftaran == 'revisi_berkas') {
                             $notifikasi_items[] = [
                                'icon' => 'fa-exclamation-circle',
                                'color' => 'red',
                                'title' => 'Revisi Diperlukan',
                                'message' => 'Ada berkas yang ditolak. Silakan cek dan perbaiki.',
                                 'url' => route('upload-berkas'),
                                'action' => 'Perbaiki Berkas'
                            ];
                        } elseif ($pendaftaran->status_pendaftaran == 'lulus_verifikasi_berkas') {
                             $notifikasi_items[] = [
                                'icon' => 'fa-check-circle',
                                'color' => 'green',
                                'title' => 'Berkas Disetujui',
                                'message' => 'Berkas Anda valid. Silakan lanjutkan ke pembayaran.',
                                 'url' => route('pembayaran'),
                                'action' => 'Bayar Sekarang'
                            ];
                        }
                    } else {
                        $notifikasi_items[] = [
                            'icon' => 'fa-info-circle',
                            'color' => 'blue',
                            'title' => 'Selamat Datang',
                            'message' => 'Silakan isi formulir pendaftaran untuk memulai proses wisuda.',
                            'url' => route('pendaftaran'),
                            'action' => 'Daftar Sekarang'
                        ];
                    }

                    $notifikasi_count = count($notifikasi_items);
                @endphp

                <div class="relative group">
                    <button class="relative p-2.5 text-gray-400 hover:text-[#0b3c39] hover:bg-emerald-50 rounded-xl transition-all">
                        <i class="fas fa-bell text-xl"></i>
                        @if($notifikasi_count > 0)
                            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        @endif
                    </button>
                    <!-- Dropdown -->
                    <div class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-50 py-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-30 transform origin-top-right">
                        <div class="px-4 mb-3 flex items-center justify-between border-b border-gray-50 pb-2">
                            <h6 class="font-bold text-gray-800">Pemberitahuan</h6>
                            @if($notifikasi_count > 0)
                                <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold">{{ $notifikasi_count }} Info</span>
                            @endif
                        </div>
                        
                        <div class="max-h-96 overflow-y-auto">
                             @foreach($notifikasi_items as $item)
                                <div class="px-4 py-3 hover:bg-gray-50 transition-colors cursor-pointer flex items-start space-x-3 border-b border-gray-50 last:border-0 relative group/item">
                                    <div class="w-8 h-8 rounded-full bg-{{ $item['color'] }}-100 flex items-center justify-center flex-shrink-0 text-{{ $item['color'] }}-600 mt-1">
                                        <i class="fas {{ $item['icon'] }} text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-gray-800 leading-tight">{{ $item['title'] }}</p>
                                        <p class="text-[10px] text-gray-500 mt-1 leading-relaxed">{{ $item['message'] }}</p>
                                        @if(isset($item['action']))
                                            <a href="{{ $item['url'] }}" class="inline-block mt-2 text-[10px] font-bold text-white bg-[#0b3c39] px-3 py-1 rounded-lg hover:bg-emerald-900 transition-colors">
                                                {{ $item['action'] }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                             @endforeach
                        </div>
                        
                        <div class="px-4 mt-2 pt-2 border-t border-gray-50 text-center bg-gray-50/50 -mb-4 py-3 rounded-b-2xl">
                            <a href="{{ url('/notifikasi') }}" class="text-[10px] font-black text-[#0b3c39] hover:underline uppercase tracking-wide">Lihat Semua Notifikasi</a>
                        </div>
                    </div>
                </div>

                <div class="h-8 w-[1px] bg-gray-100"></div>

                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-xs font-black text-gray-400 uppercase tracking-tighter">Mahasiswa</p>
                        <p class="text-sm font-bold text-gray-800">{{ explode(' ', Auth::user()->name)[0] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-[#0b3c39] rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-emerald-100 overflow-hidden">
                        @if(Auth::user()->avatar)
                            <img src="{{ \Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="p-8">
            <div class="max-w-6xl mx-auto">
                @yield('content')
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>