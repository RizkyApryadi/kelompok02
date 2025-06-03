@extends('layouts.main')

@section('title', 'List Pengumuman')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Pengumuman</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Pengumuman</button>
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
                                        <th>Judul Pengumuman</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengumumans as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('pengumuman.edit', Crypt::encrypt($data->id)) }}"
                                                    class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i>
                                                    &nbsp; Edit</a>
                                                <form method="POST"
                                                    action="{{ route('pengumuman.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm"
                                                        data-bs-toggle="tooltip" style="margin-left: 8px"><i
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

            <!-- Modal Tambah Pengumuman -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pengumuman</h5>
                            <!-- Tombol penutup modal dengan class btn-close -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="pengumuman-form" action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                                @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="judul">Judul</label>
                                            <input type="text" id="judul" name="judul"
                                                class="form-control @error('judul') is-invalid @enderror"
                                                placeholder="{{ __('Judul Pengumuman') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi"
                                                class="form-control @error('deskripsi') is-invalid @enderror"
                                                placeholder="{{ __('Deskripsi') }}"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="file">File Materi</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input id="file" type="file" name="file"
                                                        class="form-control @error('file') is-invalid @enderror">
                                                    <label class="custom-file-label" for="file">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
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
    $(document).ready(function() {
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
    $('#pengumuman-form').submit(function(event) {
        let isValid = true;
        let missingFields = [];

        // Reset kelas is-invalid
        $('#judul, #deskripsi, #file').removeClass('is-invalid');

        // Periksa apakah ada field yang kosong
        $('#judul, #deskripsi, #file').each(function() {
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
