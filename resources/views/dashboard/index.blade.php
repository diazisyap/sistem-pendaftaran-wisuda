@extends('layouts.app')

@section('content')
{{-- Menghapus class mb-4 dan mengganti dengan padding agar sesuai jarak di mockup --}}
<h2 class="mb-5" style="color: var(--main-text-color);">Sistem Pendaftaran Wisuda</h2>
<div class="mb-5" style="border-radius: 50%; width: 20px; height: 20px; background-color: #f0f0f0;"></div>

<div class="row">
    {{-- Status Pendaftaran --}}
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center" style="background-color: #0d847c; color: white; height: 100%;">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <i class="fas fa-check-circle me-2" style="font-size: 1rem;"></i>
                <h6 class="mb-0">Status Pendaftaran</h6>
            </div>
            
            <div class="progress mt-2 mx-auto" style="height: 5px; background-color: rgba(255, 255, 255, 0.3); width: 80%;">
                <div class="progress-bar" role="progressbar" style="width: 50%; background-color: white;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="mt-1">50%</small>
        </div>
    </div>
    
    {{-- Status Pembayaran --}}
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center" style="background-color: #0d847c; color: white; height: 100%;">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <i class="fas fa-check-circle me-2" style="font-size: 1rem;"></i>
                <h6 class="mb-0">Status Pembayaran</h6>
            </div>
        </div>
    </div>
    
    {{-- Pengumuman --}}
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center" style="background-color: #0d847c; color: white; height: 100%;">
            <div class="d-flex justify-content-center align-items-center mb-2">
                <i class="fas fa-bullhorn me-2" style="font-size: 1rem;"></i>
                <h6 class="mb-0">Pengumuman</h6>
            </div>
        </div>
    </div>
</div>

{{-- **CATATAN:** Bagian tombol menu cepat (Formulir, Upload, Pembayaran) yang ada di mockup sebelumnya telah dihapus agar persis seperti gambar yang Anda kirimkan saat ini. --}}

@endsection