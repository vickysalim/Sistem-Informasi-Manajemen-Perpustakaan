@extends('layout.master')

@section('title', 'Anggota')

@section('content')
    <!-- Search Data -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Anggota Baru</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6 class="mb-0"><i class="icon fas fa-ban"></i> Error! ID Anggota atau ID Buku yang Anda masukkan tidak ditemukan</h6>
                        </div>
                        <div class="form-group">
                            <label for="idAnggota">ID Anggota</label>
                            <input type="number" class="form-control" id="idAnggota" placeholder="Masukkan ID Anggota">
                        </div>
                        <div class="form-group">
                            <label for="idBuku">Nama</label>
                            <input type="text" class="form-control" id="idBuku" placeholder="Masukkan ID Buku">
                        </div>
                        <div class="form-group">
                            <label for="radioAktif">Status</label>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="radioAktif" name="status">
                                <label for="radioAktif" class="custom-control-label font-weight-normal">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="radioNonaktif" name="status">
                                <label for="radioNonaktif" class="custom-control-label font-weight-normal">Non-Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Data Peminjaman</h3>
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
                            <tr>
                                <td>1</td>
                                <td>Anggota 1</td>
                                <td>
                                    <div class="badge badge-success">Aktif</div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Anggota 2</td>
                                <td>
                                    <div class="badge badge-danger">Non-Aktif</div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(function () {
      $('#table').DataTable({
        "responsive": true,
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data peminjaman per halaman",
            "emptyTable": "<div style='margin: 16px;'>Belum ada data peminjaman</div>",
            "zeroRecords": "<div style='margin: 16px;'>Data peminjaman tidak ditemukan</div>",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data peminjaman tidak ditemukan",
            "infoFiltered": "(berdasarkan filter _MAX_ data peminjaman tersedia)",
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