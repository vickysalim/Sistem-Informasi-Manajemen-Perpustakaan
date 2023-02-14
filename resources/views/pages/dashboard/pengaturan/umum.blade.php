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
        <form action="{{ route('pengaturan.umum.update') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <p class="text-center text-muted"><i class="fas fa-school mr-1"></i> Institusi</p>
                <div class="form-group">
                    <label for="institution_name">Nama Institusi</label>
                    <input type="text" class="form-control" id="institution_name" name="institution_name" placeholder="Masukkan Nama Institusi" value="{{ $settingsData[5]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="institution_city">Kota Institusi</label>
                    <input type="text" class="form-control" id="institution_city" name="institution_city" placeholder="Masukkan Kota Institusi" value="{{ $settingsData[6]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="institution_address">Alamat Institusi</label>
                    <input type="text" class="form-control" id="institution_address" name="institution_address" placeholder="Masukkan Alamat Institusi" value="{{ $settingsData[7]->value }}" required>
                </div>
                <hr>
                <p class="text-center text-muted mt-4"><i class="fas fa-user mr-1"></i> Personil</p>
                <div class="form-group">
                    <label for="principal">Kepala Sekolah</label>
                    <input type="text" class="form-control" id="principal" name="principal" placeholder="Masukkan Nama Kepala Sekolah" value="{{ $settingsData[4]->value }}" required>
                </div>
                <div class="form-group">
                    <label for="head_librarian">Kepala Perpustakaan</label>
                    <input type="text" class="form-control" id="head_librarian" name="head_librarian" placeholder="Masukkan Nama Kepala Perpustakaan" value="{{ $settingsData[3]->value }}" required>
                </div>
                <hr>
                <p class="text-center text-muted mt-4"><i class="fas fa-sync mr-1"></i> Peminjaman</p>
                <div class="form-group">
                    <label for="loan_duration">Durasi Peminjaman</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="loan_duration" name="loan_duration" placeholder="Masukkan Durasi Peminjaman" value="{{ $settingsData[0]->value }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text">hari</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fine">Jumlah Denda</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" id="fine" name="fine" placeholder="Masukkan Jumlah Denda" value="{{ $settingsData[1]->value }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text">per hari</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="extend_limit">Batas Jumlah Peminjaman</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="extend_limit" name="extend_limit" placeholder="Masukkan Batas Jumlah Peminjaman" value="{{ $settingsData[2]->value }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text">kali</span>
                        </div>
                    </div>
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
        <form action="{{ route('pengaturan.umum.logo') }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="loanDuration">Logo Institusi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="institution_logo" name="institution_logo" accept="image/png" required>
                        <label class="custom-file-label" for="institution_logo" id="edit-institution-logo">Upload logo institusi (.png)</label>
                    </div>
                    @error('institution_logo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
        $(document).on('change', '#institution_logo', function (event) {
            $(this).next('#edit-institution-logo').html("File: " + event.target.files[0].name);
        })
    </script>
@endsection