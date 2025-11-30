<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/pendaftaran', [DashboardController::class, 'pendaftaran']);
Route::get('/upload', [DashboardController::class, 'upload']);
Route::get('/pembayaran', [DashboardController::class, 'pembayaran']);
Route::get('/notifikasi', [DashboardController::class, 'notifikasi']);
Route::get('/pengumuman', [DashboardController::class, 'pengumuman']);

Route::get('/kehadiran', function () {
    return view('kehadiran.index', [
        'title' => 'Kehadiran Wisuda'
    ]);
});

Route::get('/syarat', function () {
    return view('syaratdanketentuan.index', ['title' => 'Syarat & Ketentuan']);
});
