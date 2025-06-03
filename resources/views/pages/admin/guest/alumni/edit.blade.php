@extends('layouts.main')

@section('title', 'Edit Alumni')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
    <div class="mb-4">
        <h2 class="text-2xl font-bold">Edit Alumni</h2>
    </div>

    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full p-2 mt-1 border rounded-md"
                value="{{ old('nama', $alumni->nama) }}" required>
            @error('nama')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="angkatan" class="block text-sm font-semibold text-gray-700">Angkatan</label>
            <input type="number" name="angkatan" id="angkatan" class="w-full p-2 mt-1 border rounded-md"
                value="{{ old('angkatan', $alumni->angkatan) }}" required>
            @error('angkatan')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-semibold text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan"
                class="w-full p-2 mt-1 border rounded-md">{{ old('keterangan', $alumni->keterangan) }}</textarea>
            @error('keterangan')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-sm font-semibold text-gray-700">Foto Alumni</label>
            <input type="file" name="foto" id="foto" class="w-full p-2 mt-1 border rounded-md">
            @error('foto')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror

            @if ($alumni->foto)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Foto saat ini:</p>
                    <img src="{{ asset('storage/foto_alumni/' . $alumni->foto) }}" alt="Foto Alumni" class="h-32 mt-1">
                </div>
            @endif
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">
                Update Alumni
            </button>
        </div>
    </form>
</div>
@endsection
