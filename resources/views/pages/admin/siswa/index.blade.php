@extends('layouts.main')

@section('title', 'List Siswa')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Siswa</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Siswa</button>
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
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nis }}</td>
                                        <td>{{ $data->kelas->nama_kelas }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('siswa.show', Crypt::encrypt($data->id)) }}"
                                                    class="btn btn-primary btn-sm" style="margin-right: 8px"><i
                                                        class="nav-icon fas fa-user"></i> &nbsp; Profile</a>
                                                <a href="{{ route('siswa.edit', Crypt::encrypt($data->id)) }}"
                                                    class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i>
                                                    &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('siswa.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm"
                                                        data-toggle="tooltip" style="margin-left: 8px"><i
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

            <!-- Modal Tambah Siswa -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Siswa</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="siswa-form" action="{{ route('siswa.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-bs-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="nama">Nama Siswa</label>
                                            <input type="text" id="nama" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="{{ __('Nama Siswa') }}" value="{{ old('nama') }}">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <label for="nis">NIS</label>
                                                <input type="number" id="nis" name="nis"
                                                    class="form-control @error('nis') is-invalid @enderror"
                                                    placeholder="{{ __('NIS Siswa') }}" value="{{ old('nis') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No. Telp</label>
                                                <input type="number" id="telp" name="telp"
                                                    class="form-control @error('telp') is-invalid @enderror"
                                                    placeholder="{{ __('No. Telp Siswa') }}" value="{{ old('telp') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <select id="kelas_id" name="kelas_id"
                                                class="select2 form-control @error('kelas_id') is-invalid @enderror">
                                                <option value="">-- Pilih kelas --</option>
                                                @foreach ($kelas as $data)
                                                <option value="{{ $data->id }}" {{ old('kelas_id')==$data->id ?
                                                    'selected' : '' }}>{{ $data->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea id="alamat" name="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                placeholder="{{ __('Alamat') }}">{{ old('alamat') }}</textarea>
                                        </div>
                                        <!-- Tambahkan setelah input Alamat -->
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password login siswa">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Konfirmasi Password</label>
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                placeholder="Konfirmasi password">
                                        </div>

                                        <div class="form-group">
                                            <label for="foto">Foto Siswa</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input id="foto" type="file" name="foto"
                                                        class="form-control @error('foto') is-invalid @enderror"
                                                        value="{{ old('foto') }}">
                                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer br">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
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

<script type="text/javascript">
    // Konfirmasi Hapus
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Data akan terhapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            dangerMode: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Validasi form saat submit
    $('#siswa-form').submit(function(event) {
        let isValid = true;
        let missingFields = [];

        // Reset kelas is-invalid
        $('#nama, #nis, #telp, #kelas_id, #alamat, #foto').removeClass('is-invalid');

        // Periksa apakah ada field yang kosong
        $('#nama, #nis, #telp, #kelas_id, #alamat, #foto').each(function() {
            if ($(this).val().trim() === "") {
                isValid = false;
                missingFields.push($(this).prev('label').text());
                $(this).addClass('is-invalid');
            }
        });

        // Jika ada field yang kosong, tampilkan SweetAlert dan batalkan submit
        if (!isValid) {
            event.preventDefault(); // Mencegah form submit
            Swal.fire({
                title: 'Error!',
                text: 'Anda harus mengisi Field: ' + missingFields.join(', '),
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        }
    });
</script>

@endpush