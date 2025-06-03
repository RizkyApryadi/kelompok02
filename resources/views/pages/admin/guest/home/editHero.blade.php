@extends('layouts.main')
@section('title', 'Edit Sambutan Kepala Sekolah')

@section('content')
<div class="container mx-auto py-12 px-6">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl mx-auto">
        <h2 class="text-3xl font-extrabold text-gray-800 text-center mb-6">Edit Sambutan Kepala Sekolah</h2>

        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <!-- Upload Gambar -->
            <div>
                <label for="photo" class="block text-gray-700 font-semibold mb-2">Foto Kepala Sekolah</label>
                <input type="file" name="photo" id="photo"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @if($hero->photo)
                    <img src="{{ asset('storage/' . str_replace('public/', '', $hero->photo)) }}" alt="Foto" class="w-32 h-32 object-cover mt-4 rounded">
                @endif
            </div>

            <!-- Sambutan Kepala Sekolah -->
            <div>
                <label for="message" class="block text-gray-700 font-semibold mb-2">Sambutan</label>
                <textarea name="message" id="message" rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Tulis sambutan di sini...">{{ old('message', $hero->message) }}</textarea>
            </div>

            <!-- Nama Kepala Sekolah -->
            <div>
                <label for="headmaster_name" class="block text-gray-700 font-semibold mb-2">Nama Kepala Sekolah</label>
                <input type="text" name="headmaster_name" id="headmaster_name"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Masukkan nama kepala sekolah" value="{{ old('headmaster_name', $hero->headmaster_name) }}">
            </div>

            <button type="submit"
                class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                Update
            </button>

        </form>

    </div>
</div>
@endsection

@push('script')
@endpush