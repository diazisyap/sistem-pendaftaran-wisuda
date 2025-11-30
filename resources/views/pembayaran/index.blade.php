@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color: var(--main-text-color);">Pembayaran Wisuda</h2>

{{-- === CARD TAGIHAN === --}}
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

    <button class="btn btn-primary" style="width: 200px; background-color: var(--primary-blue); border-radius: 0; border: none;">
        Aktifkan Pembayaran
    </button>
</div>


{{-- === CARD PETUNJUK PEMBAYARAN === --}}
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



{{-- === CARD PEMBELIAN KURSI TAMBAHAN === --}}
<div class="card p-4 mb-5">
    <h5 class="mb-3">Pembelian Kursi Tamu Undangan Tambahan</h5>

    <p class="text-muted" style="font-size: 0.9rem;">
        Mahasiswa dapat melakukan pembelian kursi tambahan untuk tamu undangan yang belum tercatat dalam sistem akademik.
        Pembelian kursi bersifat opsional dan dibatasi sesuai jumlah kuota yang tersedia.
    </p>

    <div class="mb-3">
        <label class="form-label fw-bold">Jumlah Kursi Tambahan :</label>

        {{-- INPUT MANUAL --}}
        <input 
            type="number" 
            id="jumlahKursi" 
            class="form-control"
            style="width: 120px; border-radius:0;"
            min="1"
            max="10"
            value="1"
        >
    </div>

    <p class="mb-1">
        <strong>Harga per Kursi:</strong> Rp 150.000
    </p>

    <p class="mb-3">
        <strong>Total Biaya Tambahan:</strong> 
        <span id="totalBiaya" class="text-success fw-bold">Rp 150.000</span>
    </p>

    <button class="btn btn-primary" style="border-radius: 0; width: 150px;">
        Tambah
    </button>
</div>

{{-- === SCRIPT HITUNG OTOMATIS === --}}
<script>
    const jumlah = document.getElementById('jumlahKursi');
    const total = document.getElementById('totalBiaya');

    function hitung() {
        let harga = 150000;
        let jml = Math.max(1, Number(jumlah.value || 1));
        total.innerText = "Rp " + (jml * harga).toLocaleString('id-ID');
    }

    jumlah.addEventListener('input', hitung);
    jumlah.addEventListener('change', hitung);
</script>

@endsection
