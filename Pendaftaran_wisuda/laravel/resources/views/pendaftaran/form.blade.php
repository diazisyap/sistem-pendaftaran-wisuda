@extends('layouts.app')

@section('content')
<div class="panel">
  <h6>Form Pendaftaran</h6>

  <form class="mt-3">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama Lengkap</label>
        <input class="form-control" placeholder="Nama sesuai KTP">
      </div>
      <div class="col-md-6">
        <label class="form-label">NIM</label>
        <input class="form-control" placeholder="NIM">
      </div>

      <div class="col-md-6">
        <label class="form-label">Program Studi</label>
        <input class="form-control" placeholder="Contoh: Teknik Informatika">
      </div>

      <div class="col-md-6">
        <label class="form-label">No. HP</label>
        <input class="form-control" placeholder="08xxxxxxxxxx">
      </div>

      <div class="col-12">
        <label class="form-label">Alamat</label>
        <input class="form-control" placeholder="Alamat lengkap">
      </div>

      <div class="col-12 d-flex justify-content-end">
        <button class="btn" style="background:var(--accent); color:#fff">Simpan & Lanjut</button>
      </div>
    </div>
  </form>
</div>
@endsection
