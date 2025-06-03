@extends('layouts.main')
@section('title', 'Edit Prestasi Akademik')

@section('content')
<br><br>
<div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
    <h2>Edit Prestasi Akademik</h2>

    <form action="{{ route('prestasi-akademik.update', $prestasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 16px;">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $prestasi->nama_lengkap) }}" required class="form-control">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan</label>
            <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan', $prestasi->tanggal_pelaksanaan) }}" required class="form-control">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="kejuruan">Kejuruan</label>
            <input type="text" id="kejuruan" name="kejuruan" value="{{ old('kejuruan', $prestasi->kejuruan) }}" required class="form-control">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="tingkat">Tingkat</label>
            <input type="text" id="tingkat" name="tingkat" value="{{ old('tingkat', $prestasi->tingkat) }}" required class="form-control">
        </div>

        <div style="margin-bottom: 16px;">
            <label for="penyelenggara">Penyelenggara</label>
            <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara', $prestasi->penyelenggara) }}" required class="form-control">
        </div>

        <div style="text-align: right;">
            <button type="submit" class="btn btn-success">Update Data</button>
        </div>
    </form>
</div>
@endsection
