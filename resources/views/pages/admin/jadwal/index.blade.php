@extends('layouts.main')

@section('title', 'List Jadwal')

@push('style')
<!-- Include SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endpush

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Jadwal</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Jadwal</button>
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
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Dari jam</th>
                                        <th>Sampai jam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $result => $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->mapel->nama_mapel }}</td>
                                        <td>{{ $data->kelas->nama_kelas }}</td>
                                        <td>{{ Str::ucfirst($data->hari) }}</td>
                                        <td>{{ $data->dari_jam }}</td>
                                        <td>{{ $data->sampai_jam }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('jadwal.edit', $data->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                <form method="POST" action="{{ route('jadwal.destroy', $data->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm show_confirm" data-bs-toggle="tooltip" style="margin-left: 8px"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
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

            <!-- Modal Tambah Jadwal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="jadwal-form" action="{{ route('jadwal.store') }}" method="POST">
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
                                            <label for="mapel_id">Mata Pelajaran</label>
                                            <select id="mapel_id" name="mapel_id" class="select2 form-control @error('mapel_id') is-invalid @enderror">
                                                <option value="">-- Pilih Mata Pelajaran --</option>
                                                @foreach ($mapel as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas_id">Kelas</label>
                                            <select id="kelas_id" name="kelas_id" class="select2 form-control @error('kelas_id') is-invalid @enderror">
                                                <option value="">-- Pilih Kelas --</option>
                                                @foreach ($kelas as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="hari">Hari</label>
                                            <select id="hari" name="hari" class="select2 form-control @error('hari') is-invalid @enderror">
                                                <option value="">-- Pilih Hari --</option>
                                                <option value="senin">Senin</option>
                                                <option value="selasa">Selasa</option>
                                                <option value="rabu">Rabu</option>
                                                <option value="kamis">Kamis</option>
                                                <option value="jumat">Jumat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dari_jam">Mulai dari jam</label>
                                            <input class="form-control" type="text" name="dari_jam" id="time1" value="{{ old('dari_jam') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sampai_jam">Sampai dari jam</label>
                                            <input class="form-control" type="text" name="sampai_jam" id="time2" value="{{ old('sampai_jam') }}" />
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
        $('#exampleModal').modal('show');
    });
</script>
@endif

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

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

    // Validasi form untuk memastikan tidak ada field yang kosong
    $('#jadwal-form').submit(function(event) {
        var valid = true;

        // Reset class error sebelumnya
        $('#jadwal-form input, #jadwal-form select').removeClass('is-invalid');

        // Cek setiap field untuk melihat apakah kosong
        $('#jadwal-form input, #jadwal-form select').each(function() {
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

    // Inisialisasi datetimepicker
    $('#time1, #time2').datetimepicker({
        format: 'HH:mm:ss',
        use24hours: true,
        stepping: 15, // Langkah waktu 15 menit
    });
</script>
@endpush
