@extends('layouts.main')
@section('title', 'Tambah Prestasi Akademik')

@section('content')
<br><br>
<div style="background-color: rgb(255, 255, 255); padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); margin-top: 20px;">
        <h2 style="font-size: 24px; font-weight: bold; color: #2d3748; text-align: left;">Tambah Data Prestasi Non-Akademik</h2>

        <form action="{{ route('prestasi-non-akademik.store')}}" method="POST">
            @csrf
            <div style="margin-bottom: 16px;">
                <label for="nama_lengkap" style="font-size: 16px; font-weight: bold; color: #2d3748;">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                @error('nama_lengkap')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="tanggal_pelaksanaan" style="font-size: 16px; font-weight: bold; color: #2d3748;">Tanggal Pelaksanaan</label>
                <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                @error('tanggal_pelaksanaan')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="kejuruan" style="font-size: 16px; font-weight: bold; color: #2d3748;">Kejuruan</label>
                <input type="text" id="kejuruan" name="kejuruan" value="{{ old('kejuruan') }}" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                @error('kejuruan')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="tingkat" style="font-size: 16px; font-weight: bold; color: #2d3748;">Tingkat</label>
                <input type="text" id="tingkat" name="tingkat" value="{{ old('tingkat') }}" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                @error('tingkat')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 16px;">
                <label for="penyelenggara" style="font-size: 16px; font-weight: bold; color: #2d3748;">Penyelenggara</label>
                <input type="text" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" required
                    style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                @error('penyelenggara')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div style="text-align: right;">
                <button type="submit" style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer;">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
@endsection