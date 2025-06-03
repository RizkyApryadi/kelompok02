@extends('layouts.main')

@section('title', 'Edit Aktivitas')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold mb-6">Edit Aktivitas</h2>

    <form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md mb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
            <input type="text" id="judul" name="judul" class="w-full border-gray-300 rounded-md"
                value="{{ old('judul', $aktivitas->judul) }}">
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="6" class="w-full border-gray-300 rounded-md">{{ old('deskripsi', $aktivitas->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="w-full border-gray-300 rounded-md" value="{{ old('tanggal', $aktivitas->tanggal) }}">
        </div>

        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar Baru (Opsional)</label>
            <input type="file" id="gambar" name="gambar" class="w-full border-gray-300 rounded-md">
            @if($aktivitas->gambar)
                <img src="{{ asset('storage/' . $aktivitas->gambar) }}" alt="Gambar" class="mt-2 w-40 rounded-md">
            @endif
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                Update Aktivitas
            </button>
        </div>
    </form>
</div>
@endsection