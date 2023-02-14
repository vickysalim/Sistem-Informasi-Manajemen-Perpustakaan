@extends('layout.master')

@section('link')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
@endsection

@section('foundation')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            @if (file_exists('storage/logo/logo.png'))
                <img src="{{ asset('storage/logo/logo.png') }}" height="32" class="d-inline-block align-top" alt="">
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link nav-link {{ Route::currentRouteName() == 'main' ? 'active' : '' }}" href="{{ route('main') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link {{ Route::currentRouteName() == 'pengunjung' ? 'active' : '' }}" href="{{ route('pengunjung') }}">Pengunjung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link {{ Route::currentRouteName() == 'tentang' ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
                </li>
            </ul>
            @auth
            <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('dashboard') }}">Dashboard</a>    
            @endauth
            @guest
            <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('login') }}">Login</a>
            @endguest
        </div>
    </nav>

    <section class="content" style="min-height: calc(100vh - 120px);">
        @yield('content')
    </section>

    <footer class="m-0 main-footer">
        <div class="float-right d-none d-sm-block">
            {{ config('app.name') }}
        </div>
        Copyright &copy; {{ now()->year }}
    </footer>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endsection