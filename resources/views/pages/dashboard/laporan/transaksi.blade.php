@extends('layout.master')

@section('title', 'Laporan Transaksi Peminjaman')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cek Laporan Transaksi Peminjaman</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6 class="mb-0"><i class="icon fas fa-ban"></i> Error! Data yang Anda masukkan tidak valid</h6>
                        </div>
                        <div class="form-group">
                            <label for="tanggalCetak">Tanggal Cetak</label>
                            <input type="date" class="form-control" id="tanggalCetak">
                        </div>
                        <div class="form-group">
                            <label for="thnAjaranAwal">Tahun Ajaran</label>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Juli</span>
                                        </div>
                                        <input type="number" class="form-control" id="thnAjaranAwal">
                                    </div>
                                </div>
                                <div class="col-sm-2 text-center">
                                    s/d
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Juni</span>
                                        </div>
                                        <input type="number" class="form-control" id="thnAjaranAwal">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('tanggalCetak').valueAsDate = new Date();
    </script>
@endsection