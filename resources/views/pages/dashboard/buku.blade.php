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
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
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
                    <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun" required>
                    @error('tahun')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN" required>
                    @error('isbn')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan Jenis" required>
                    @error('jenis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cover">Cover Buku</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="cover" name="cover" accept="image/*">
                        <label class="custom-file-label" for="cover" id="cover-label">Upload foto cover buku (.jpg atau .png)</label>
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
                                <div class="d-block">
                                    <button type="button" class="btn btn-primary btn-sm edit-button" data-toggle="modal" data-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                                </div>
                                @if(!$item->cover_url)
                                    <div class="badge badge-warning">
                                        <i class="fas fa-exclamation-triangle"></i> Belum ada cover buku
                                    </div>
                                @else
                                    <a class="btn btn-link btn-sm p-0" target="_blank" href="{{ asset('storage/cover/'.$item->cover_url) }}">Klik untuk akses cover</a>
                                @endif
                            </td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Data Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Data Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('login') }}" method="POST" method="POST" enctype="multipart/form-data" id="modalForm">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="editId">ID Buku</label>
                            <input type="number" class="form-control" id="editId" name="idBuku" placeholder="Masukkan ID Buku" required>
                        </div>
                        <div class="form-group">
                            <label for="editTitle">Judul</label>
                            <input type="text" class="form-control" id="editTitle" name="judul" placeholder="Masukkan Judul" required>
                        </div>
                        <div class="form-group">
                            <label for="editAuthor">Pengarang</label>
                            <input type="text" class="form-control" id="editAuthor" name="pengarang" placeholder="Masukkan Pengarang" required>
                        </div>
                        <div class="form-group">
                            <label for="editPublisher">Penerbit</label>
                            <input type="text" class="form-control" id="editPublisher" name="penerbit" placeholder="Masukkan Penerbit" required>
                        </div>
                        <div class="form-group">
                            <label for="editYear">Tahun</label>
                            <input type="number" class="form-control" id="editYear" name="tahun" placeholder="Masukkan Tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="editIsbn">ISBN</label>
                            <input type="number" class="form-control" id="editIsbn" name="isbn" placeholder="Masukkan ISBN" required>
                        </div>
                        <div class="form-group">
                            <label for="editType">Jenis</label>
                            <input type="text" class="form-control" id="editType" name="jenis" placeholder="Masukkan Jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="editCover">Cover Buku</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="editCover" name="updateCover" accept="image/*">
                                <label class="custom-file-label" for="editCover" id="edit-cover-label">Upload foto cover buku (.jpg atau .png)</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @error('updateCover')
        {{ $message }}
    @enderror
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
  <script>
    $(document).on('change', '#cover', function (event) {
        $(this).next('#cover-label').html("File: " + event.target.files[0].name);
    })
  </script>
  <script>
    $(function() {
        $('table').on('click', 'button.edit-button',function (ele) {
            var tr = ele.target.parentNode.parentNode.parentNode;

            var id = tr.cells[0].textContent;
            var title = tr.cells[1].textContent;
            var author = tr.cells[2].textContent;
            var publisher = tr.cells[3].textContent;
            var year = tr.cells[4].textContent;
            var isbn = tr.cells[5].textContent;
            var type = tr.cells[6].textContent;

            $('#editId').val(id);
            $('#editTitle').val(title);
            $('#editAuthor').val(author);
            $('#editPublisher').val(publisher);
            $('#editYear').val(year);
            $('#editIsbn').val(isbn);
            $('#editType').val(type);

            // submit url from route
            var url = "{{ route('buku.update', ':id') }}";
            url = url.replace(':id', id);

            $("form#modalForm").attr('action', url);
        });
    });
  </script>
  <script>
    $(document).on('change', '#editCover', function (event) {
        $(this).next('#edit-cover-label').html("File: " + event.target.files[0].name);
    })
  </script>
@endsection