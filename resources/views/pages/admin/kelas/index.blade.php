@extends('layouts.main')

@section('title', 'List Kelas')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Kelas</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Kelas
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
                                        <th>Nama Kelas</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_kelas }}</td>
                                        <td>{{ $data->guru->nama }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('kelas.edit', $data->id) }}" class="btn btn-success btn-sm" style="margin-right: 8px">
                                                    <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                                                </a>
                                                <form method="POST" action="{{ route('kelas.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" style="margin-left: 8px">
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

            <!-- Modal Tambah Kelas -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Kelas</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="kelas-form" action="{{ route('kelas.store') }}" method="POST">
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
                                            <label for="nama_kelas">Nama Kelas</label>
                                            <input type="text" id="nama_kelas" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="{{ __('Nama Kelas') }}" value="{{ old('nama_kelas') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="guru_id">Wali Kelas</label>
                                            <select id="guru_id" name="guru_id" class="select2 form-control @error('guru_id') is-invalid @enderror">
                                                <option value="">-- Pilih Wali Kelas --</option>
                                                @foreach ($guru as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan_id">Jurusan</label>
                                            <select id="jurusan_id" name="jurusan_id" class="select2 form-control @error('jurusan_id') is-invalid @enderror">
                                                <option value="">-- Pilih Jurusan --</option>
                                                @foreach ($jurusan as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_jurusan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" id="btn-simpan" class="btn btn-primary">Simpan</button>
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
        // Menampilkan modal jika ada error
        $('#exampleModal').modal('show');
    });
</script>
@endif

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    // Menggunakan SweetAlert untuk konfirmasi hapus
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

    // Menampilkan SweetAlert jika ada field kosong saat form disubmit
    $('#kelas-form').submit(function(event) {
        let isValid = true;
        let missingFields = [];

        // Reset all previous error styles
        $('#nama_kelas, #guru_id, #jurusan_id').removeClass('is-invalid'); // Reset the invalid class for previous errors

        // Periksa apakah ada field yang kosong
        $('#nama_kelas, #guru_id, #jurusan_id').each(function() {
            if ($(this).val().trim() === "") {
                isValid = false;
                missingFields.push($(this).prev('label').text());
                $(this).addClass('is-invalid'); // Menambahkan class is-invalid untuk menandai error
            }
        });

        if (!isValid) {
            event.preventDefault(); // Mencegah form untuk disubmit jika ada field kosong
            Swal.fire({
                title: 'Error!',
                text: 'Field berikut harus diisi: ' + missingFields.join(', '),
                icon: 'error',
                confirmButtonText: 'Tutup'
            });
        }
    });
</script>
@endpush
