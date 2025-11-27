@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" style="color: var(--main-text-color);">Pengumuman</h2>

    <div class="card p-4 mb-4">
        <div class="mb-4">
            <h5 class="mb-0 font-weight-bold">Informasi Detail Pengumuman</h5>
        </div>
        
        <div class="row">
            <div class="col-12">
                <h3 class="font-weight-bold">Gladi Bersih</h3>
                
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="font-weight-bold mb-1">📅 Tanggal Pelaksanaan:</p>
                        <p>15 Agustus 2025</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="font-weight-bold mb-1">⏰ Waktu:</p>
                        <p>07.00 WIB</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <p class="font-weight-bold mb-1">📍 Lokasi:</p>
                        <p>Auditorium Kampus</p>
                    </div>
                </div>

                <div class="alert alert-warning mt-3" role="alert">
                    <h5 class="alert-heading">CATATAN PENTING:</h5>
                    <p class="mb-0">Mahasiswa calon wisudawan/wisudawati **wajib hadir sebelum waktu yang telah ditentukan** untuk registrasi dan persiapan.</p>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-secondary btn-sm">Pengumuman Lainnya</button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection