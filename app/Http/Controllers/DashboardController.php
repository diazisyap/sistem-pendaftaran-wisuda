<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Desktop 1
    public function dashboard()
    {
        return view('dashboard.index');
    }

    // Desktop 2
    public function pendaftaran()
    {
        return view('pendaftaran.index');
    }

    // Desktop 3
    public function upload()
    {
        return view('upload.index');
    }

    // Desktop 4
    public function pembayaran()
    {
        return view('pembayaran.index');
    }

    // Desktop 5
    public function notifikasi()
    {
        return view('notifikasi.index');
    }

    // Desktop 6
    public function pengumuman()
    {
        return view('pengumuman.index');    
    }
}