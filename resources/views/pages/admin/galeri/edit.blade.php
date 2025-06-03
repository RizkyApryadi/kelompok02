@extends('layouts.main')
@section('title', 'Edit Galeri')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                                </button>
                                @foreach ($errors->all() as $error )
                                    {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Edit Galeri {{ $galeri->judul }}</h4>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('galeri.update', $galeri->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="foto">File Galeri</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input id="file" type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" value="{{ $pengumuman->file ?? '' }}">
                                            <label class="custom-file-label" for="file">{{ $galeri->file ?? '' }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="judul">Judul Galeri</label>
                                    <input type="text" id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="{{ __('Judul Galeri') }}" value="{{ $galeri->judul ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="{{ __('Deskripsi') }}">{{ $galeri->deskripsi ?? '' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
