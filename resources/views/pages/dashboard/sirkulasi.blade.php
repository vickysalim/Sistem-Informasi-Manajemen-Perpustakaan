@extends('layout.dashboard')

@section('title', 'Sirkulasi')

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

    <!-- Search Data -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Peminjaman Baru</h3>
        </div>
        <form action="{{ route('sirkulasi.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="idAnggota">ID Anggota</label>
                    <input type="number" class="form-control" id="idAnggota" name="idAnggota" placeholder="Masukkan ID Anggota">
                    @error('idAnggota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="idBuku">ID Buku</label>
                    <input type="number" class="form-control" id="idBuku" name="idBuku" placeholder="Masukkan ID Buku">
                    @error('idBuku')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data Peminjaman Aktif</h3>
        </div>
        <div class="card-body">
            <table class="table dt-responsive nowrap mt-2 dataTable no-footer dtr-inline collapsed" id="table">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Anggota</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Perpanjang</th>
                        <th>Kembalikan</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $extendLimit = $extendLimitData->value;
                    @endphp
                    @foreach ($circulationData as $item)
                        <tr>
                            <td>
                                ID: {{ $item->book_id }}<br>
                                <span class="text-sm">{{ $item->Book->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                ID: {{ $item->member_id }}<br>
                                <span class="text-sm">{{ $item->Member->name ?? 'N/A' }}</span>
                            </td>
                            <td>
                                {{ date('d M Y', strtotime($item->loan_date)) }}<br>
                                @if ($item->extend_count > 0)
                                    <span class="text-sm">Perpanjangan ke-{{ $item->extend_count }} pada {{ date('d M Y', strtotime($item->latest_extend_date)) }}</span>
                                @endif
                            </td>
                            <td>{{ date('d M Y', strtotime($item->return_date)) }}</td>
                            <td>
                                @if ($item->extend_count >= $extendLimit)
                                    <span class="text-sm">Sudah melewati batas</span>
                                @else
                                    <form method="POST" action="{{ route('sirkulasi.extend', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Perpanjang
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('sirkulasi.return', $item->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            </td>
                            <td>
                                @php
                                    $diff = date_diff(date_create(date('Y-m-d')), date_create($item->return_date));
                                @endphp

                                @if($diff->format('%R%a') < 0)
                                    Rp. {{ abs($diff->format('%R%a') * $fineData->value) }}
                                @else
                                    Rp. 0
                                @endif
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