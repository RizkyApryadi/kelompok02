@extends('layouts.main')

@section('title', 'List Guru')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Guru</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Guru
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
                                        <th>Nama Guru</th>
                                        <th>NIP</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guru as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nip }}</td>
                                        <td>{{ $data->mapel->nama_mapel }} | {{ $data->mapel->jurusan->nama_jurusan }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('guru.show', Crypt::encrypt($data->id)) }}" class="btn btn-primary btn-sm" style="margin-right: 8px"><i class="nav-icon fas fa-user"></i> &nbsp; Profile</a>
                                                <a href="{{ route('guru.edit', Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('guru.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
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

            <!-- Modal Tambah Guru -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data Guru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="guru-form" action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <label for="nama">Nama Guru</label>
                                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama Guru') }}" value="{{ old('nama') }}">
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="number" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="{{ __('NIP Guru') }}" value="{{ old('nip') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No. Telp</label>
                                                <input type="number" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="{{ __('No. Telp Guru') }}" value="{{ old('no_telp') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mapel_id">Mapel</label>
                                            <select id="mapel_id" name="mapel_id" class="select2 form-control @error('mapel_id') is-invalid @enderror">
                                                <option value="">-- Pilih Mapel --</option>
                                                @foreach ($mapel as $data)
                                                <option value="{{ $data->id }}" {{ old('mapel_id') == $data->id ? 'selected' : '' }}>{{ $data->nama_mapel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}">{{ old('alamat') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Foto Guru</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input id="foto" type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer br">
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
@if ($errors->any())
<script>
    $(document).ready(function() {
        // Menampilkan modal jika ada error
        $('#exampleModal').modal('show');
    });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    // Konfirmasi sebelum menghapus data
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

    // Validasi form dan mencegah submit jika ada field yang kosong
    $('#guru-form').submit(function(event) {
        var valid = true;

        // Reset class error sebelumnya
        $('#guru-form input, #guru-form textarea, #guru-form select').removeClass('is-invalid');

        // Cek setiap field untuk melihat apakah kosong
        $('#guru-form input, #guru-form textarea, #guru-form select').each(function() {
            if ($(this).val() === "" || $(this).val() === null) {
                $(this).addClass('is-invalid'); // Tambahkan class 'is-invalid' jika field kosong
                valid = false;
            }
        });

        // Jika ada field kosong, tampilkan alert dan cegah form submit
        if (!valid) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Harap lengkapi semua field yang diperlukan.'
            });
        }
    });
</script>
@endpush
