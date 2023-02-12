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
            <h3 class="card-title">Tambah Akun Baru</h3>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" placeholder="Masukkan Nama Lengkap" required>
                    @error('namaLengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="radioAdmin">Tipe Akun</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="radioAdmin" name="tipeAkun" value="Admin" required>
                        <label for="radioAdmin" class="custom-control-label font-weight-normal">Admin</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="radioPetugas" name="tipeAkun" value="Petugas">
                        <label for="radioPetugas" class="custom-control-label font-weight-normal">Petugas</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="radioKepalaSekolah" name="tipeAkun" value="Kepala Sekolah">
                        <label for="radioKepalaSekolah" class="custom-control-label font-weight-normal">Kepala Sekolah</label>
                    </div>
                    @error('tipeAkun')
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
            <h3 class="card-title">Data Akun</h3>
        </div>
        <div class="card-body">
            <table class="table dt-responsive nowrap mt-2 dataTable no-footer dtr-inline collapsed" id="table">
                <thead>
                    <tr>
                        <th>ID Akun</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tipe Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accountData as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <span class="badge badge-success">{{ $item->role }}</span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm edit-button" data-toggle="modal" data-target="#editModal">Edit</button>
                                <form action="{{ route('pengaturan.akun.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
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
                    <h5 class="modal-title" id="ModalLabel">Edit Data Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('login') }}" method="POST" method="POST" id="modalForm">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="editName">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editName" name="name" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" placeholder="Masukkan Email" required>
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
        "language": {
            "lengthMenu": "Menampilkan _MENU_ data akun per halaman",
            "emptyTable": "<div style='margin: 16px;'>Belum ada data akun</div>",
            "zeroRecords": "<div style='margin: 16px;'>Data akun tidak ditemukan</div>",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data akun tidak ditemukan",
            "infoFiltered": "(berdasarkan filter _MAX_ data akun tersedia)",
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
            var name = tr.cells[1].textContent.trim();
            var email = tr.cells[2].textContent;

            $('#editName').val(name);
            $('#editEmail').val(email);

            // submit url from route
            var url = "{{ route('pengaturan.akun.update', ':id') }}";
            url = url.replace(':id', id);

            console.log(url);
            $("form#modalForm").attr('action', url);
        });
    });
</script>
@endsection