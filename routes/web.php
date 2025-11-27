<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route Root mengarahkan ke Dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Routes untuk 5 Tampilan Utama
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/pendaftaran', [DashboardController::class, 'pendaftaran']);
Route::get('/upload', [DashboardController::class, 'upload']);
Route::get('/pembayaran', [DashboardController::class, 'pembayaran']);
Route::get('/notifikasi', [DashboardController::class, 'notifikasi']);
Route::get('/pengumuman', [DashboardController::class, 'pengumuman']);

// Tambahkan routes placeholder untuk menu lain (Kehadiran, Pengumuman, Syarat)
Route::get('/kehadiran', function () { return view('placeholder', ['title' => 'Kehadiran']); });
Route::get('/syarat', function () { return view('placeholder', ['title' => 'Syarat & Ketentuan']); });