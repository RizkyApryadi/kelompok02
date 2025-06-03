@extends('layouts.main')
@section('title', 'List Siswa')

@section('content')
<section class="section custom-section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        </div>
                        @endif
                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
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
                                    @foreach ($pengumuman as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $data ->deskripsi }}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="{{ route('siswa.pengumuman.download', $data->id) }}" class="btn btn-success btn-sm align-self-center"><i class="nav-icon fas fa-download"></i> &nbsp; Download Pengumuman</a>
                                            </div>
                                        </td>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection