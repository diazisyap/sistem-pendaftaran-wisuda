@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color: var(--main-text-color);">Notifikasi</h2>

<div class="accordion" id="notifikasiAccordion">
    
    {{-- Notifikasi 1: Terverifikasi --}}
    <div class="accordion-item" style="border-radius: 0; margin-bottom: 10px;">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed fw-bold" type="button" 
                data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                aria-expanded="false" aria-controls="collapseOne" 
                style="border-radius: 0; background-color: white;">
                Terverifikasi
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#notifikasiAccordion">
            <div class="accordion-body">
                Pembayaran Anda telah terverifikasi.
            </div>
        </div>
    </div>
    
    {{-- ... Notifikasi 2 dan 3 lainnya ... --}}

</div>
@endsection