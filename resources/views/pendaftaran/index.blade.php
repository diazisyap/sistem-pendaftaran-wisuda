@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color: var(--main-text-color);">Pendaftaran Wisuda</h2>

{{-- Step Indicator --}}
<div class="d-flex mb-4">
    <div class="p-2 me-3 fw-bold" style="background-color: var(--primary-green); color: white; border-radius: 5px; display: flex; align-items: center;"><i class="fas fa-check me-2"></i> Identitas</div>
    <div class="p-2 me-3 border border-secondary rounded" style="color: var(--main-text-color); display: flex; align-items: center;"><i class="far fa-square me-2"></i> Dokumen</div>
    <div class="p-2 me-3 border border-secondary rounded" style="color: var(--main-text-color); display: flex; align-items: center;"><i class="far fa-square me-2"></i> Pembayaran</div>
</div>

<div class="card p-4">
    <h5 class="mb-4">Form Pendaftaran</h5>
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" placeholder="Tulis Namamu" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="nim" placeholder="Tulis NIM" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" class="form-control" id="prodi" placeholder="Program Studimu" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Skripsi</label>
            <input type="text" class="form-control" id="judul" placeholder="Tulis Namamu" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="pembimbing1" class="form-label">Pembimbing 1</label>
            <input type="text" class="form-control" id="pembimbing1" placeholder="Tulis NIM" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="pembimbing2" class="form-label">Pembimbing 2</label>
            <input type="text" class="form-control" id="pembimbing2" placeholder="Program Studimu" style="border-radius: 0;">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Aktif</label>
            <input type="email" class="form-control" id="email" placeholder="Tulis email aktif" style="border-radius: 0;">
        </div>

        <button type="submit" class="btn btn-primary mt-3" style="background-color: var(--primary-blue); border-radius: 0; border: none;">Next</button>
    </form>
</div>
@endsection