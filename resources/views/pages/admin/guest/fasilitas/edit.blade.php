@extends('layouts.main')
@section('title', 'Edit Fasilitas')

@section('content')
<div class="w-full bg-white py-10 px-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-6">Edit Fasilitas</h2>

    <form action="{{ route('fasilitas.update', $fasilitas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Fasilitas</label>
            <input type="text" name="nama" class="w-full border px-3 py-2 rounded"
                   value="{{ old('nama', $fasilitas->nama) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border px-3 py-2 rounded" rows="4" required>{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Foto (opsional)</label>
            <input type="file" name="foto" class="w-full border px-3 py-2 rounded">

            @if ($fasilitas->foto)
                <p class="text-sm mt-2">Foto saat ini:</p>
                <img src="{{ asset('storage/' . $fasilitas->foto) }}" alt="Foto Fasilitas" class="mt-1 w-32 h-32 object-cover rounded">
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
    </form>
</div>
@endsection
