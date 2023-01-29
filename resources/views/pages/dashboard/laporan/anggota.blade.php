@extends('layout.master')

@section('title', 'Laporan Anggota')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cek Laporan Anggota</h3>
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