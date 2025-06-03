@extends('layouts.main')
@section('title', 'List Jurusan')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Jurusan</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Jurusan
                        </button>
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
                                        <th>Nama Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusan as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_jurusan }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('jurusan.edit', $data->id) }}"
                                                    class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i>
                                                    &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('jurusan.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm"
                                                        data-toggle="tooltip" style="margin-left: 8px">
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

            <!-- Modal Tambah Jurusan -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="jurusan-form" action="{{ route('jurusan.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-bs-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                @foreach ($errors->all() as $error )
                                                <p>{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="nama_jurusan">Nama Jurusan</label>
                                            <input type="text" id="nama_jurusan" name="nama_jurusan"
                                                class="form-control @error('nama_jurusan') is-invalid @enderror"
                                                value="{{ old('nama_jurusan') }}"
                                                placeholder="{{ __('Nama Jurusan') }}">
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
    $(document).ready(function() {
        // Menampilkan modal ketika ada error
        $('#exampleModal').modal('show');
    });
</script>
@endif

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    // Konfirmasi Hapus Data
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            text: "Data akan terhapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Validasi form sebelum disubmit
    $('#jurusan-form').submit(function(event) {
        var valid = true;

        // Reset class error sebelumnya
        $('#jurusan-form input').removeClass('is-invalid');

        // Cek apakah input nama_jurusan kosong
        if ($('#nama_jurusan').val().trim() === "") {
            $('#nama_jurusan').addClass('is-invalid');
            valid = false;
        }

        // Jika ada error, tampilkan alert dan cegah form disubmit
        if (!valid) {
            event.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Nama Jurusan harus diisi!',
                icon: 'error',
            });
        }
    });
</script>
@endpush
