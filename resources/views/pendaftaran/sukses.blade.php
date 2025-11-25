?>
@extends('layouts.app')


@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl mt-10 text-center">
<h1 class="text-3xl font-bold text-green-600 mb-4">Pendaftaran Berhasil!</h1>
<p class="text-gray-700 text-lg mb-6">Selamat <span class="font-semibold">{{ session('nama') }}</span>, akun Anda berhasil dibuat.</p>


<a href="/" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kembali ke Halaman Utama</a>
</div>
@endsection