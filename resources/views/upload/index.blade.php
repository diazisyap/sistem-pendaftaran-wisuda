@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color: var(--main-text-color);">Upload Dokumen</h2>

<div class="card p-4">
    <div class="row text-center mb-5">
        <div class="col-md-6">
            <h5 class="mb-3">Foto Formal</h5>
            <div class="bg-light mx-auto" style="width: 150px; height: 180px; border: 1px solid #ccc; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #aaa;">
                <i class="fas fa-user"></i>
            </div>
            <button class="btn btn-dark btn-sm mt-3" style="border-radius: 0;">Upload</button>
        </div>
        <div class="col-md-6">
            <h5 class="mb-3">Foto Bebas</h5>
            <div class="bg-light mx-auto" style="width: 150px; height: 180px; border: 1px solid #ccc; border-radius: 5px; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #aaa;">
                <i class="fas fa-user"></i>
            </div>
            <button class="btn btn-dark btn-sm mt-3" style="border-radius: 0;">Upload</button>
        </div>
    </div>

    <h5 class="mb-4">Lengkapi Berkas</h5>
    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Upload Surat Pernyataan" readonly style="border-radius: 0;">
            <button class="btn btn-dark" type="button" style="border-radius: 0;">Submit</button>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Upload Transkip Nilai" readonly style="border-radius: 0;">
            <button class="btn btn-dark" type="button" style="border-radius: 0;">Submit</button>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Upload KRS Terpenuhi" readonly style="border-radius: 0;">
            <button class="btn btn-dark" type="button" style="border-radius: 0;">Submit</button>
        </div>
    </form>
</div>
@endsection