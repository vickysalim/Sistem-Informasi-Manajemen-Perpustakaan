@extends('layout.main')

@section('title', 'Beranda')

@section('content')
    <!-- Search Book -->
    <section class="jumbotron text-center" style="height: 82vh;">
        <div class="container">
            <h1>Input Kunjungan</h1>
            <p class="lead text-muted">Silakan masukkan nomor keanggotaan Anda.</p>
            <form action="{{ route('pengunjung.store') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Masukkan nomor anggota" name="nomorAnggota" autofocus>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Konfirmasi</button>
                    </div>
                </div>
            </form>
            <!-- Alert Message -->
            @if (session()->has('danger'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h6 class="mb-0"><i class="icon fas fa-ban"></i> 
                    {{ session()->get('danger') }}
                </h6>
            </div>
            @endif
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h6 class="mb-0"><i class="icon fas fa-check"></i> {{ session()->get('success') }}</h6>
            </div>
            @endif
        </div>
    </section>
@endsection