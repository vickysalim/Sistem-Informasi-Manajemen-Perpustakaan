@extends('layout.main')

@section('title', 'Beranda')

@section('content')
<section class="jumbotron text-center bg-white">
    <div class="container">
        <h1>Tentang Aplikasi</h1>
        <p class="lead text-muted">Selamat datang di website Perpustakaan {{ $settingsData[5]->value }}. Aplikasi ini digunakan untuk mengelola perpustakaan di {{ $settingsData[5]->value }} yang dapat digunakan untuk menecari berbagai jenis buku serta meminjam buku.</p>
        <p class="lead text-muted">Alamat Institusi: {{ $settingsData[7]->value }}</p>
        @if (file_exists('storage/logo/logo.png'))
            <img src="{{ asset('storage/logo/logo.png') }}" height="256">
        @endif
    </div>
</section>
@endsection