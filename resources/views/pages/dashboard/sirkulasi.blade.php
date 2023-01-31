@extends('layout.dashboard')

@section('title', 'Sirkulasi')

@section('content')
    <!-- Search Data -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Peminjaman Baru</h3>
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
                            <label for="idBuku">ID Buku</label>
                            <input type="number" class="form-control" id="idBuku" placeholder="Masukkan ID Buku">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cari</button>
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
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Perpanjang</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ABC</td>
                                <td>Buku 1</td>
                                <td>27/01/2023</td>
                                <td>29/01/2023</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">Perpanjang</button>
                                </td>
                                <td>Rp 0</td>
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