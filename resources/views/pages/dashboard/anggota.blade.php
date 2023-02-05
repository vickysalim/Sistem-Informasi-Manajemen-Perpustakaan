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
                                        @method('PATCH')
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            Ubah Status
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm edit-button" data-toggle="modal" data-target="#editModal">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota {{ $item->name }} (ID: {{ $item->id }})? Tindakan ini tidak dapat dibatalkan.')">Hapus</button>
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
                    <h5 class="modal-title" id="ModalLabel">Edit Data Anggota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('login') }}" method="POST" method="POST" id="modalForm">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="editId">ID Anggota</label>
                            <input type="number" name="idAnggota" class="form-control" id="editId" placeholder="ID Anggota" required>
                        </div>
                        <div class="form-group">
                            <label for="editName">Nama</label>
                            <input type="text" name="nama" class="form-control" id="editName" placeholder="Nama Anggota" required>
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
    <script>
        $(function() {
            $('table').on('click', 'button.edit-button',function (ele) {
                var tr = ele.target.parentNode.parentNode;

                var id = tr.cells[0].textContent;
                var name = tr.cells[1].textContent;

                $('#editId').val(id);
                $('#editName').val(name);

                // submit url from route
                var url = "{{ route('anggota.update', ':id') }}";
                url = url.replace(':id', id);

                console.log(url);
                $("form#modalForm").attr('action', url);
            });
        });
    </script>
@endsection