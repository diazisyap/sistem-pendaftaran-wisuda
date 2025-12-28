<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Pendaftaran Wisuda' }}</title>
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
    </style>
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen sidebar shadow-xl flex flex-col fixed left-0 top-0">
        <div class="p-6 flex items-center space-x-3 border-b border-white/10">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center">
                <i class="fas fa-graduation-cap text-[#0b3c39] text-xl"></i>
            </div>
            <span class="text-xl font-bold text-white">Wisuda Admin</span>
        </div>

        <nav class="flex-1 px-4 mt-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large w-6"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.pendaftaran') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.pendaftaran') ? 'active' : '' }}">
                <i class="fas fa-users w-6"></i>
                <span class="font-medium">Data Pendaftar</span>
            </a>
            <a href="{{ route('admin.verifikasi.berkas') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.verifikasi.berkas') ? 'active' : '' }}">
                <i class="fas fa-file-shield w-6"></i>
                <span class="font-medium">Verifikasi Berkas</span>
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.pembayaran') ? 'active' : '' }}">
                <i class="fas fa-wallet w-6"></i>
                <span class="font-medium">Pembayaran</span>
            </a>
            <a href="{{ route('admin.jadwal.wisuda') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.jadwal.wisuda') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt w-6"></i>
                <span class="font-medium">Jadwal Wisuda</span>
            </a>
            <a href="{{ route('admin.pengumuman') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.pengumuman') ? 'active' : '' }}">
                <i class="fas fa-bullhorn w-6"></i>
                <span class="font-medium">Pengumuman</span>
            </a>
            <a href="{{ route('admin.manajemen.mahasiswa') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.manajemen.mahasiswa') ? 'active' : '' }}">
                <i class="fas fa-user-graduate w-6"></i>
                <span class="font-medium">Manajemen Mhs</span>
            </a>
            <a href="{{ route('admin.data.final') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.data.final') ? 'active' : '' }}">
                <i class="fas fa-file-signature w-6"></i>
                <span class="font-medium">Data Final</span>
            </a>
            <a href="{{ route('admin.generate.qr') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.generate.qr') ? 'active' : '' }}">
                <i class="fas fa-qrcode w-6"></i>
                <span class="font-medium">Generate QR</span>
            </a>
            <a href="{{ route('admin.scanner') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.scanner') ? 'active' : '' }}">
                <i class="fas fa-camera w-6"></i>
                <span class="font-medium">Scanner QR</span>
            </a>
            <a href="{{ route('admin.laporan') }}" class="sidebar-link flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-6"></i>
                <span class="font-medium">Laporan</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <a href="{{ url('/logout') }}" class="flex items-center px-4 py-3 bg-amber-400 text-amber-950 font-black rounded-xl transition-all hover:bg-amber-500 justify-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Log out
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen">
        <!-- Top Navbar -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-10 p-4 border-b border-gray-100 flex items-center justify-between">
            <h1 class="text-xl font-bold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            <div class="flex items-center space-x-6">
                <button class="relative p-2 text-gray-400 hover:text-[#0b3c39] transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                <div class="flex items-center space-x-3 bg-gray-50 px-4 py-2 rounded-xl">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-[#0b3c39] font-medium capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <img src="{{ Auth::user()->avatar ? \Storage::url(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0b3c39&color=fff' }}" class="w-10 h-10 rounded-xl shadow-sm object-cover" alt="Avatar">
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="p-8">
            @yield('content')
        </div>
    </main>
</body>
</html>
