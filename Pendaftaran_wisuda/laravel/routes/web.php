<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Student\SettingsController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/pendaftaran', [DashboardController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/edit', [DashboardController::class, 'editPendaftaran'])->name('pendaftaran.edit');
    Route::post('/pendaftaran/update', [DashboardController::class, 'updatePendaftaran'])->name('pendaftaran.update');
    
    Route::get('/upload-berkas', [DashboardController::class, 'upload'])->name('upload-berkas');
    Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');

    Route::get('/pembayaran', [DashboardController::class, 'pembayaran'])->name('pembayaran');
    Route::post('/pembayaran/kursi', [DashboardController::class, 'updateKursi'])->name('pembayaran.kursi');
    Route::post('/pembayaran/store', [DashboardController::class, 'storePembayaran'])->name('pembayaran.store');
    Route::get('/notifikasi', [DashboardController::class, 'notifikasi'])->name('notifikasi');
    Route::get('/pengumuman', [DashboardController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/e-ticket', [DashboardController::class, 'eTicket'])->name('e-ticket');
    Route::get('/kehadiran', [DashboardController::class, 'kehadiran'])->name('kehadiran');
    Route::get('/syarat', function() {
        return view('syarat.index');
    })->name('syarat');

    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('student.settings');
    Route::put('/pengaturan/profile', [SettingsController::class, 'updateProfile'])->name('student.settings.profile');
    Route::put('/pengaturan/password', [SettingsController::class, 'updatePassword'])->name('student.settings.password');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/pendaftaran', [AdminController::class, 'pendaftaran'])->name('pendaftaran');
    
    Route::get('/verifikasi-berkas', [AdminController::class, 'verifikasiBerkas'])->name('verifikasi.berkas');
    Route::get('/verifikasi-berkas/{id}', [AdminController::class, 'verifikasiBerkasDetail'])->name('verifikasi.berkas.detail');
    Route::post('/verifikasi-berkas/{id}/approve', [AdminController::class, 'approveBerkas'])->name('verifikasi.berkas.approve');
    Route::post('/verifikasi-berkas/{id}/reject', [AdminController::class, 'rejectBerkas'])->name('verifikasi.berkas.reject');
    Route::post('/verifikasi-berkas/{id}/doc/{doc}', [AdminController::class, 'updateDocStatus'])->name('verifikasi.berkas.doc.update');

    Route::get('/pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
    Route::get('/pembayaran/{id}', [AdminController::class, 'pembayaranDetail'])->name('pembayaran.detail');
    Route::post('/pembayaran/{id}/approve', [AdminController::class, 'approvePembayaran'])->name('pembayaran.approve');
    Route::post('/pembayaran/{id}/reject', [AdminController::class, 'rejectPembayaran'])->name('pembayaran.reject');
    
    Route::get('/jadwal-wisuda', [AdminController::class, 'jadwalWisuda'])->name('jadwal.wisuda');
    Route::post('/jadwal-wisuda', [AdminController::class, 'storeJadwal'])->name('jadwal.wisuda.store');
    Route::put('/jadwal-wisuda/{id}', [AdminController::class, 'updateJadwal'])->name('jadwal.wisuda.update');
    Route::delete('/jadwal-wisuda/{id}', [AdminController::class, 'deleteJadwal'])->name('jadwal.wisuda.delete');
    
    Route::get('/manajemen-mahasiswa', [AdminController::class, 'manajemenMahasiswa'])->name('manajemen.mahasiswa');
    Route::put('/manajemen-mahasiswa/{id}', [AdminController::class, 'updateMahasiswa'])->name('manajemen.mahasiswa.update');
    Route::delete('/manajemen-mahasiswa/{id}', [AdminController::class, 'deleteMahasiswa'])->name('manajemen.mahasiswa.delete');
    
    Route::get('/pengumuman', [AdminController::class, 'pengumuman'])->name('pengumuman');
    Route::post('/pengumuman', [AdminController::class, 'storePengumuman'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [AdminController::class, 'updatePengumuman'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [AdminController::class, 'deletePengumuman'])->name('pengumuman.delete');
    
    Route::get('/data-final', [AdminController::class, 'dataFinal'])->name('data.final');
    Route::get('/export-final', [AdminController::class, 'exportFinal'])->name('export.final');
    Route::get('/export-all', [AdminController::class, 'exportAllPendaftaran'])->name('export.all');
    Route::get('/export-laporan-keuangan', [AdminController::class, 'exportLaporanKeuangan'])->name('export.laporan.keuangan');
    Route::post('/pendaftaran/{id}/reject', [AdminController::class, 'rejectPendaftaran'])->name('pendaftaran.reject');
    
    Route::get('/generate-qr', [AdminController::class, 'generateQr'])->name('generate.qr');
    Route::post('/generate-qr-single/{id}', [AdminController::class, 'generateQrSingle'])->name('generate.qr.single');
    Route::post('/generate-qr-bulk', [AdminController::class, 'generateQrBulk'])->name('generate.qr.bulk');
    
    Route::get('/scanner', [AdminController::class, 'scanner'])->name('scanner');
    Route::post('/scan', [AdminController::class, 'storeScan'])->name('scan.store');
    
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
});
