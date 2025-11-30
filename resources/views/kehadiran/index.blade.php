@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Kehadiran Wisuda</h3>
    <p class="text-muted">Status kehadiran mahasiswa dan wali.</p>

    {{-- KEHADIRAN MAHASISWA --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            Kehadiran Mahasiswa
        </div>
        <div class="card-body">
            <p><strong>Status Kehadiran:</strong> Sudah hadir / Belum</p>
            <p><strong>Waktu Scan:</strong> 27 Nov 2025 - 07:00</p>
            <p><strong>Status Barcode:</strong> Belum digunakan</p>
        </div>
    </div>

    {{-- KEHADIRAN WALI --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            Kehadiran Wali
        </div>
        <div class="card-body">
            <p><strong>Status Kehadiran:</strong> Sudah / Belum</p>
            <p><strong>Waktu Scan:</strong> -</p>
            <p><strong>Status Barcode:</strong> Kuota wali terpakai / belum digunakan</p>
        </div>
    </div>

</div>
@endsection
