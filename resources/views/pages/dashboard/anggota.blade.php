@extends('layout.dashboard')

@section('title', 'Anggota')

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
            <h3 class="card-title">Tambah Anggota Baru</h3>
        </div>
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="idAnggota">ID Anggota</label>
                    <input type="number" class="form-control" id="idAnggota" name="idAnggota" placeholder="Masukkan ID Anggota" required>
                    @error('idAnggota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="radioAktif">Status</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="radioAktif" name="status" value="Aktif" required>
                        <label for="radioAktif" class="custom-control-label font-weight-normal">Aktif</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="radioNonaktif" name="status" value="Non-Aktif">
                        <label for="radioNonaktif" class="custom-control-label font-weight-normal">Non-Aktif</label>
                    </div>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data Anggota</h3>
        </div>
        <div class="card-body">
            <table class="table dt-responsive nowrap mt-2 dataTable no-footer dtr-inline collapsed" id="table">
                <thead>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($memberData as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="badge badge-{{ $item->status == "Aktif" ? "success" : "danger"}}">{{ $item->status }}</div>
                                <div>
                                    <form method="POST" action="{{ route('anggota.switch', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            Ubah Status
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(function () {
      $('#table').DataTable({
        "responsive": false,
        "scrollX": true,
        "autoWidth": false,
        "order": [[2, "asc"]],
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data anggota per halaman",
            "emptyTable": "<div style='margin: 16px;'>Belum ada data anggota</div>",
            "zeroRecords": "<div style='margin: 16px;'>Data anggota tidak ditemukan</div>",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data anggota tidak ditemukan",
            "infoFiltered": "(berdasarkan filter _MAX_ data anggota tersedia)",
            "paginate": {
                "first":      "Awal",
                "last":       "Akhir",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
            "search": "Cari:"
        }
      });
    });
  </script>
@endsection