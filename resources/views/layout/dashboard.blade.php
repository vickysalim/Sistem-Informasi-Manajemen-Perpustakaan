@extends('layout.master')

@section('link')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('body_class', 'hold-transition sidebar-mini')

@section('foundation')
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <div class="text-center p-2">
                            <img src="{{ asset('dist/img/avatar.png')}}" class="img-size-50 img-circle">
                            <p class="mt-2 font-weight-bold">{{ Auth::User()->name }}</p>
                            <p class="mt-1 text-muted">{{ Auth::User()->email }}</p>
                            <p class="mt-1 text-muted">{{ Auth::User()->role }}</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-footer text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <a href="{{ url('') }}" class="brand-link">
                    <span class="brand-text font-weight-light">{{ preg_filter('/[^A-Z]/', '', config('app.name')) }}</span>
                </a>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sirkulasi') }}" class="nav-link {{ Route::currentRouteName() == 'sirkulasi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sync"></i>
                                <p>Sirkulasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('anggota') }}" class="nav-link {{ Route::currentRouteName() == 'anggota' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buku') }}" class="nav-link {{ Route::currentRouteName() == 'buku' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Laporan<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('laporan.transaksi') }}" class="nav-link {{ Route::currentRouteName() == 'laporan.transaksi' ? 'active' : '' }}" class="nav-link">
                                        <i class="fas fa-balance-scale nav-icon"></i>
                                        <p>Transaksi Peminjaman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('laporan.anggota') }}" class="nav-link {{ Route::currentRouteName() == 'laporan.anggota' ? 'active' : '' }}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Anggota</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('laporan.pengunjung') }}" class="nav-link {{ Route::currentRouteName() == 'laporan.pengunjung' ? 'active' : '' }}" class="nav-link">
                                        <i class="fas fa-edit nav-icon"></i>
                                        <p>Pengunjung</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </section>
            <div class="m-2">
                <section class="content">
                    @yield('content')
                </section>
            </div>
        </div>
        
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                {{ config('app.name') }}
            </div>
            Copyright &copy; {{ now()->year }}
        </footer>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    
    @yield('script')
@endsection