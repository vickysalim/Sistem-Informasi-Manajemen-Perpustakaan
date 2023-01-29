@extends('layout.master')

@section('title', 'Buku')

@section('content')
    <!-- Search Data -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Buku Baru</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h6 class="mb-0"><i class="icon fas fa-ban"></i> Error! Data yang Anda masukkan tidak valid</h6>
                        </div>
                        <div class="form-group">
                            <label for="idBuku">ID Buku</label>
                            <input type="number" class="form-control" id="idBuku" placeholder="Masukkan ID Buku">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" placeholder="Masukkan Judul">
                        </div>
                        <div class="form-group">
                            <label for="pengarang">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" placeholder="Masukkan Pengarang">
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" placeholder="Masukkan Penerbit">
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" class="form-control" id="tahun" placeholder="Masukkan Tahun">
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="number" class="form-control" id="isbn" placeholder="Masukkan ISBN">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input type="text" class="form-control" id="jenis" placeholder="Masukkan Jenis">
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover Buku</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover">
                                <label class="custom-file-label" for="cover">Upload foto cover buku (.jpg atau .png)</label>
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
                    <h3 class="card-title">Data Buku</h3>
                </div>
                <div class="card-body">
                    <table class="table dt-responsive nowrap mt-2 dataTable no-footer dtr-inline collapsed" id="table">
                        <thead>
                            <tr>
                                <th>ID Buku</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>ISBN</th>
                                <th>Jenis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Buku 1</td>
                                <td>Nama Pengarang 1, Nama Pengarang 2</td>
                                <td>Penerbit Buku</td>
                                <td>2023</td>
                                <td>1234567890123</td>
                                <td>Buku Fiksi</td>
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
            "lengthMenu": "Menampilkan _MENU_ data buku per halaman",
            "emptyTable": "<div style='margin: 16px;'>Belum ada data buku</div>",
            "zeroRecords": "<div style='margin: 16px;'>Data buku tidak ditemukan</div>",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data buku tidak ditemukan",
            "infoFiltered": "(berdasarkan filter _MAX_ data buku tersedia)",
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