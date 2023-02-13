@extends('layout.dashboard')

@section('title', 'Pengaturan Umum')

@section('content')
    <!-- Alert Message -->
    @if (session()->has('danger'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h6 class="mb-0"><i class="icon fas fa-ban"></i> {{ session()->get('danger') }}</h6>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h6 class="mb-0"><i class="icon fas fa-check"></i> {{ session()->get('success') }}</h6>
        </div>
    @endif

    <!-- General Settings -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pengaturan Aplikasi</h3>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="loanDuration">Durasi Peminjaman</label>
                    <input type="number" class="form-control" id="loanDuration" name="loanDuration" placeholder="Masukkan Durasi Peminjaman (dalam format hari)" value="{{ $settingsData[0]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="fine">Jumlah Denda per Hari</label>
                    <input type="number" class="form-control" id="fine" name="fine" placeholder="Masukkan Jumlah Denda per Hari (dalam format nominal denda)" value="{{ $settingsData[1]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="extendLimit">Batas Jumlah Peminjaman</label>
                    <input type="number" class="form-control" id="extendLimit" name="extendLimit" placeholder="Masukkan Batas Jumlah Peminjaman (dalam format angka)" value="{{ $settingsData[2]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="headLibrarian">Kepala Perpustakaan</label>
                    <input type="text" class="form-control" id="headLibrarian" name="headLibrarian" placeholder="Masukkan Nama Kepala Perpustakaan" value="{{ $settingsData[3]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="principal">Kepala Sekolah</label>
                    <input type="text" class="form-control" id="principal" name="principal" placeholder="Masukkan Nama Kepala Sekolah" value="{{ $settingsData[4]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="institutionName">Nama Institusi</label>
                    <input type="text" class="form-control" id="institutionName" name="institutionName" placeholder="Masukkan Nama Institusi" value="{{ $settingsData[5]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="institutionCity">Kota Institusi</label>
                    <input type="text" class="form-control" id="institutionCity" name="institutionCity" placeholder="Masukkan Kota Institusi" value="{{ $settingsData[6]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="institutionAddress">Alamat Institusi</label>
                    <input type="text" class="form-control" id="institutionAddress" name="institutionAddress" placeholder="Masukkan Alamat Institusi" value="{{ $settingsData[7]->value }}" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>

    <!-- Logo Settings -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pengaturan Logo</h3>
        </div>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="loanDuration">Logo Institusi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="institutionLogo" name="institutionLogo" accept="image/*">
                        <label class="custom-file-label" for="institutionLogo" id="edit-institution-logo">Upload logo institusi (.jpg atau .png)</label>
                    </div>
                    @if ($settingsData[8]->value != null)
                        <a class="btn btn-link btn-sm p-0" target="_blank" href="{{ asset('storage/logo/'.$settingsData[8]->value) }}">Klik untuk akses logo</a>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('change', '#institutionLogo', function (event) {
            $(this).next('#edit-institution-logo').html("File: " + event.target.files[0].name);
        })
    </script>
@endsection