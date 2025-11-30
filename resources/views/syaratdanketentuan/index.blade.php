@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

@section('content')

<div class="card p-4">
    <h3 class="mb-4">Syarat dan Ketentuan Pendaftaran Wisuda</h3>

    <h5>1. Ketentuan Pendaftar</h5>
    <ul class="mt-2 mb-4">
        <li>Mahasiswa hanya dapat melakukan pendaftaran wisuda 1 kali.</li>
        <li>Data yang diinput harus sesuai dengan data akademik kampus.</li>
        <li>Pendaftaran dinyatakan selesai jika semua berkas dan pembayaran terverifikasi.</li>
    </ul>

    <h5>2. Berkas Wajib</h5>
    <p class="mt-2">Mahasiswa wajib mengunggah:</p>
    <ul class="mb-4">
        <li>Surat pernyataan wisuda</li>
        <li>Pas foto formal</li>
        <li>Transkrip nilai</li>
    </ul>

    <div class="form-check mt-3">
        <input class="form-check-input" type="checkbox" id="setuju">
        <label class="form-check-label" for="setuju">
            Saya telah membaca dan menyetujui
        </label>
    </div>
</div>

@endsection