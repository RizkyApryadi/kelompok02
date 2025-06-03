@extends('layouts.main')

@section('title', 'Tambah Aktivitas')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold mb-6">Tambah Aktivitas</h2>

    <form action="{{ route('aktivitas.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md mb-8">
        @csrf
        <!-- Form fields yang tadi kamu buat -->
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul</label>
            <input type="text" id="judul" name="judul" class="w-full border-gray-300 rounded-md"
                placeholder="Masukkan judul" value="{{ old('judul') }}">
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="6" class="w-full border-gray-300 rounded-md"
                placeholder="Masukkan deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="w-full border-gray-300 rounded-md" value="{{ old('tanggal') }}">
        </div>

        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 font-semibold mb-2">Gambar</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" class="w-full border-gray-300 rounded-md">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
                Simpan Aktivitas
            </button>
        </div>
    </form>
</div>
@endsection
