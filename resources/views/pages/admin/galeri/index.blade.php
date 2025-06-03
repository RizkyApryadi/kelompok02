@extends('layouts.main')
@section('title', 'List Galeri')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Galeri</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Galeri
                        </button>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="btn-close" data-bs-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="btn-close" data-bs-dismiss="alert">
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
                                        <th>Judul Galeri</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($galeris as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('galeri.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm">
                                                    <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                                                </a>
                                                <form method="POST" action="{{ route('galeri.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm" data-bs-toggle="tooltip" style="margin-left: 8px">
                                                        <i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus
                                                    </button>
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

            <!-- Modal Tambah Galeri -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="galeri-form" action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="{{ __('Judul Galeri') }}">
                                            @error('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="{{ __('Deskripsi') }}"></textarea>
                                            @error('deskripsi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="file">File Gambar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input id="file" type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                                    <label class="custom-file-label" for="file">Pilih file</label>
                                                </div>
                                            </div>
                                            @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary">Simpan</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    // Konfirmasi sebelum menghapus data
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: `Yakin ingin menghapus data ini?`,
            text: "Data akan terhapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Hapus",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Cek form dan validasi sebelum submit
    $('#submit-btn').click(function(event) {
        event.preventDefault(); // Mencegah form submit langsung

        // Reset is-invalid class sebelum validasi
        $('#galeri-form input, #galeri-form textarea').removeClass('is-invalid');

        var emptyFields = [];
        var valid = true;

        // Cek field kosong
        $('#galeri-form input, #galeri-form textarea').each(function() {
            if ($(this).val() === "") {
                $(this).addClass('is-invalid');  // Menandai field yang kosong
                emptyFields.push($(this).attr('name'));  // Menyimpan nama field yang kosong
                valid = false;
            }
        });

        if (!valid) {
            // Menampilkan pesan SweetAlert jika ada field yang kosong
            var message = "Field berikut harus diisi: " + emptyFields.join(", ");
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message,
            });
        } else {
            // Jika semua field valid, kirim form
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data akan disimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#galeri-form').submit();  // Submit form jika tombol "Ya" ditekan
                }
            });
        }
    });
</script>
@endpush
