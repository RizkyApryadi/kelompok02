@extends('layouts.main')

@section('title', 'List User')

@section('content')
    <section class="section custom-section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>List User</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                    class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data User</button>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-bs-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-bs-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $result => $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->roles }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <form method="POST" action="{{ route('user.destroy', $data->id) }}"
                                                            class="delete-form">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="tooltip" title='Delete'
                                                                style="margin-left: 8px"><i
                                                                    class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah User -->
                <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible show fade">
                                                    <div class="alert-body">
                                                        <button class="close" data-dismiss="alert">
                                                            <span>&times;</span>
                                                        </button>
                                                        @foreach ($errors->all() as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="{{ __('Email User') }}" value="{{ old('email') }}">
                                            </div>
                                            <input name="password" type="password" value="password123" hidden>
                                            <div class="form-group">
                                                <label for="roles">Roles</label>
                                                <select id="roles" name="roles"
                                                    class="select2 form-control @error('roles') is-invalid @enderror">
                                                    <option value="">-- Pilih Roles --</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="guru">Guru</option>
                                                    <option value="siswa">Siswa</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="noId"></div>
                                        </div>
                                    </div>
                                    <div class="modal- br">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('script')
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#roles').change(function () {
                var kel = $('#roles option:selected').val();
                if (kel == "guru") {
                    $("#noId").html('<label for="nip">NIP guru</label><input id="nip" type="text" onkeypress="return inputAngka(event)" placeholder="NIP Guru" class="form-control" name="nip" autocomplete="off">');
                } else if (kel == "siswa") {
                    $("#noId").html(`<label for="nis">NIS Siswa</label><input id="nis" type="text" placeholder="NIS Siswa" class="form-control" name="nis" autocomplete="off">`);
                } else if (kel == "admin") {
                    $("#noId").html(`<label for="name">Nama Admin</label><input id="name" type="text" placeholder="Nama admin" class="form-control" name="name" autocomplete="off">`);
                } else {
                    $("#noId").html("")
                }
            });
        });

    </script>

    <script type="text/javascript">
        // Validasi Form dan konfirmasi submit
        $('#submit-btn').click(function (event) {
            event.preventDefault(); // Mencegah form submit langsung

            // Reset is-invalid class sebelum memulai validasi
            $('#email').removeClass('is-invalid');
            $('#roles').removeClass('is-invalid');

            var errorMessages = [];
            var emptyFields = [];

            // Ambil value dari field
            var email = $('#email').val();
            var roles = $('#roles').val();

            // Cek jika ada field yang kosong
            if (email === "") {
                emptyFields.push("Email");
                $('#email').addClass('is-invalid');  // Menambahkan class is-invalid pada field yang kosong
            }
            if (roles === "") {
                emptyFields.push("Roles");
                $('#roles').addClass('is-invalid');  // Menambahkan class is-invalid pada field yang kosong
            }

            // Jika ada field yang kosong, tampilkan pesan SweetAlert yang spesifik
            if (emptyFields.length > 0) {
                var message = "Tolong isi field berikut: " + emptyFields.join(", ");
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: message,
                });
            } else {
                // Jika semua field sudah diisi, submit form
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan disimpan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, simpan!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form
                        $('#user-form').submit();
                    }
                });
            }
        });
    </script>

    <!-- untuk notif hapus -->
    <script>
        $(document).ready(function () {
            // Konfirmasi SweetAlert sebelum menghapus
            $('.delete-form').submit(function (event) {
                event.preventDefault(); // Mencegah form langsung submit

                // Menampilkan konfirmasi SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi berhasil, submit form
                        this.submit();
                    }
                });
            });
        });
    </script>


@endpush