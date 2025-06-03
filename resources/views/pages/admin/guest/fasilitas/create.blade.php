@extends('layouts.main')
@section('title', 'Tambah Fasilitas')

@section('content')
<div class="w-full bg-white py-10 px-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-6">Tambah Fasilitas</h2>

    <form action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Fasilitas</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Foto (opsional)</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
