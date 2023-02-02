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
                <form action="{{ route('sirkulasi.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
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
                        <div class="form-group">
                            <label for="idAnggota">ID Anggota</label>
                            <input type="number" class="form-control" id="idAnggota" name="idAnggota" placeholder="Masukkan ID Anggota">
                        </div>
                        <div class="form-group">
                            <label for="idBuku">ID Buku</label>
                            <input type="number" class="form-control" id="idBuku" name="idBuku" placeholder="Masukkan ID Buku">
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
                    <h3 class="card-title">Data Peminjaman Aktif</h3>
                </div>
                <div class="card-body">
                    <table class="table dt-responsive nowrap mt-2 dataTable no-footer dtr-inline collapsed" id="table">
                        <thead>
                            <tr>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Nomor Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Perpanjang</th>
                                <th>Kembalikan</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($circulationData as $item)
                                <tr>
                                    <td>{{ $item->book_id }}</td>
                                    <td>{{ $item->Book->name ?? 'N/A' }}</td>
                                    <td>{{ $item->member_id }}</td>
                                    <td>{{ $item->Member->name ?? 'N/A' }}</td>
                                    <td>{{ $item->loan_date }}</td>
                                    <td>{{ $item->return_date }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm">Perpanjang</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm">Kembalikan</a>
                                    </td>
                                    <td>
                                        @php
                                            $diff = date_diff(date_create(date('Y-m-d')), date_create($item->return_date));

                                            if($diff->format('%R%a') < 0) {
                                                echo 'Rp. ' . abs($diff->format('%R%a') * $fineData->value);
                                            } else {
                                                echo 'Rp. 0';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
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