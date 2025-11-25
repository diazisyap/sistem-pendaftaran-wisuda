@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color: var(--main-text-color);">Pembayaran Wisuda</h2>

<div class="card p-4 mb-4">
    <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i> Informasi Tagihan</h5>
    
    <div class="row">
        <div class="col-md-6">
            <dl class="row mb-4">
                <dt class="col-sm-4 text-muted">Tagihan</dt>
                <dd class="col-sm-8">: Rp 50.000</dd>

                <dt class="col-sm-4 text-muted">Toga</dt>
                <dd class="col-sm-8">: Rp 60.000</dd>
            
                <dt class="col-sm-4 text-muted">Selempang</dt>
                <dd class="col-sm-8">: Rp 60.000</dd>

                <dt class="col-sm-4 text-muted">Baju Wisuda</dt>
                <dd class="col-sm-8">: Rp 120.000</dd>
            </dl>
        </div>
    </div>
    <button class="btn btn-primary" style="width: 200px; background-color: var(--primary-blue); border-radius: 0; border: none;">Aktifkan Pembayaran</button>
</div>

<div class="card p-4 mb-4">
    <h5 class="mb-3">Petunjuk Pembayaran</h5>
    <div class="border p-3 rounded mb-4">
        <p class="text-muted" style="font-size: 0.9rem;">
            Berikut Langkah melakukan pembayaran
        </p>
        <div class="d-flex justify-content-end">
            <a href="#" class="me-3 text-decoration-none fw-bold" style="color: var(--main-text-color);">Finpay</a>
            <a href="#" class="text-decoration-none fw-bold" style="color: var(--primary-green);">Shopeepay</a>
        </div>
    </div>

    <form>
        <label for="uploadBukti" class="form-label">Upload bukti Pembayaran</label>
        <div class="input-group">
            <input type="file" class="form-control" id="uploadBukti" style="border-radius: 0;">
            <button class="btn btn-dark" type="submit" style="border-radius: 0;">Upload</button>
        </div>
    </form>
</div>
@endsection