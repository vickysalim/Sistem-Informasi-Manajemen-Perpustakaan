@extends('layout.master')

@section('title', 'Beranda')

@section('content')
    <!-- Statistics -->
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>100</h3>
                    <p>Jumlah Anggota</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">Info selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>100</h3>
                    <p>Jumlah Buku</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">Info selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>100</h3>
                    <p>Jumlah Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="fa fa-people-arrows"></i>
                </div>
                <a href="#" class="small-box-footer">Info selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>100</h3>
                    <p>Jumlah Pengembalian</p>
                </div>
                <div class="icon">
                    <i class="fa fa-undo"></i>
                </div>
                <a href="#" class="small-box-footer">Info selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endsection