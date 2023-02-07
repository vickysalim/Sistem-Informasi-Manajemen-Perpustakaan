@extends('layout.dashboard')

@section('title', 'Buku')

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
            <h3 class="card-title">Tambah Buku Baru</h3>
        </div>
        <form action="{{ route('buku.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="idBuku">ID Buku</label>
                    <input type="number" class="form-control" id="idBuku" name="idBuku" placeholder="Masukkan ID Buku" required>
                    @error('idBuku')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul" required>
                    @error('judul')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pengarang">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukkan Pengarang" required>
                    @error('pengarang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan Penerbit" required>
                    @error('penerbit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun">
                    @error('tahun')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN">
                    @error('isbn')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan Jenis">
                    @error('jenis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cover">Cover Buku</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="cover" name="cover">
                        <label class="custom-file-label" for="cover">Upload foto cover buku (.jpg atau .png)</label>
                    </div>
                    @error('cover')
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
                    @foreach ($bookData as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }} </td>
                            <td>{{ $item->author }}</td>
                            <td>{{ $item->publisher }}</td>
                            <td>{{ $item->year }}</td>
                            <td>{{ $item->isbn }}</td>
                            <td>{{ $item->type }}</td>
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