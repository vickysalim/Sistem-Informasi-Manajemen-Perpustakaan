@extends('layout.dashboard')

@section('title', 'Laporan Buku')

@section('content')
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

    <!-- Search Data -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cek Laporan Buku</h3>
        </div>
        <form>
            <div class="card-body">
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
@endsection

@section('script')
    <script>
        document.getElementById('tanggalCetak').valueAsDate = new Date();
    </script>
@endsection