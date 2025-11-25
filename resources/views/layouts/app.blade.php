<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Wisuda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --sidebar-bg: #0b3c39; /* Warna hijau gelap */
            --active-item-bg: rgba(255, 255, 255, 0.1);
            --active-line-color: #fff;
            --main-text-color: #495057;
            --light-bg: #f8f9fa;
            --primary-green: #0d847c;
            --primary-blue: #007bff;
            --primary-orange: #ffc107; /* Warna Log out */
        }
        body { background-color: var(--light-bg); margin: 0; padding: 0; font-family: sans-serif; }
        
        /* === SIDEBAR STYLES === */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            padding: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 20px 0 10px;
            text-align: center;
            /* Hapus border bawah yang terlihat di mockup yang duplikat */
            /* border-bottom: 1px solid rgba(255, 255, 255, 0.1); */ 
        }
        .sidebar-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-bottom: 5px;
            border: 2px solid white;
        }
        .sidebar-header h5 { font-size: 1rem; margin: 0; font-weight: 500;}
        
        .sidebar ul {
            list-style: none;
            padding: 10px 0;
        }
        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ccc;
            text-decoration: none;
            transition: background-color 0.1s;
        }
        .sidebar ul li a i { margin-right: 15px; width: 15px; }
        
        .sidebar ul li.active a {
            background-color: var(--active-item-bg);
            color: white;
            border-left: 4px solid var(--active-line-color);
            font-weight: 600;
        }
        
        /* === TOP NAVIGATION & CONTENT === */
        .top-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 5px 20px; /* Padding lebih kecil */
            background: white;
            border-bottom: 1px solid #eee;
            margin-left: 250px;
            height: 70px; /* Tinggikan sedikit agar tombol log out terlihat proporsional */
        }
        .content-area {
            margin-left: 250px;
            padding: 40px;
        }
        .logout-btn { 
            background-color: var(--primary-orange); 
            color: var(--main-text-color);
            font-weight: 600;
            border: none;
            padding: 8px 15px;
            border-radius: 3px;
            text-decoration: none;
            line-height: 1; /* Penting untuk menjaga tinggi tombol */
        }
        .bell-icon {
            font-size: 1.2rem; 
            color: var(--main-text-color);
            cursor: pointer;
        }
        .dropdown-menu {
            border-radius: 0;
        }
    </style>
</head>
<body>
    
    <?php $current_route = request()->segment(1) ?: 'dashboard'; ?>

    <div class="sidebar">
        <div class="sidebar-header">
            {{-- HANYA FOTO PROFIL DAN NAMA PROFIL --}}
            <img src="https://via.placeholder.com/60/007bff/ffffff?text=P" alt="Profil">
            <h5>Profil</h5>
        </div>
        <ul>
            <li class="{{ $current_route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('/dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="{{ $current_route == 'pendaftaran' ? 'active' : '' }}">
                <a href="{{ url('/pendaftaran') }}"><i class="fas fa-graduation-cap"></i> Pendaftaran Wisuda</a>
            </li>
            <li class="{{ $current_route == 'upload' ? 'active' : '' }}">
                <a href="{{ url('/upload') }}"><i class="fas fa-upload"></i> Upload Dokumen</a>
            </li>
            <li class="{{ $current_route == 'pembayaran' ? 'active' : '' }}">
                <a href="{{ url('/pembayaran') }}"><i class="fas fa-money-bill-wave"></i> Pembayaran</a>
            </li>
            <li class="{{ $current_route == 'kehadiran' ? 'active' : '' }}">
                <a href="{{ url('/kehadiran') }}"><i class="fas fa-calendar-check"></i> Kehadiran</a>
            </li>
            <li class="{{ $current_route == 'pengumuman' ? 'active' : '' }}">
                <a href="{{ url('/pengumuman') }}"><i class="fas fa-bullhorn"></i> Pengumuman</a>
            </li>
            <li class="{{ $current_route == 'syarat' ? 'active' : '' }}">
                <a href="{{ url('/syarat') }}"><i class="fas fa-scroll"></i> Syarat & Ketentuan</a>
            </li>
        </ul>
    </div>

    {{-- HANYA ADA DI TOP NAV --}}
    <div class="top-nav">
        <div class="dropdown me-3">
            <button class="btn p-0 bell-icon-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                <i class="bell-icon fas fa-bell"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1" style="min-width: 300px;">
                <h6 class="dropdown-header">Notifikasi Terbaru</h6>
                <li><a class="dropdown-item" href="{{ url('/notifikasi') }}">Pembayaran Anda terverifikasi.</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center text-primary" href="{{ url('/notifikasi') }}">Lihat Semua</a></li>
            </ul>
        </div>
        
        <a href="{{ url('/logout') }}" class="logout-btn">Log out</a>
    </div>
    
    <div class="content-area">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>