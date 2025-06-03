@extends('layouts.main')
@section('title', 'Daftar Sambutan Kepala Sekolah')

@section('content')
    <div class="container mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full">
            <div class="flex justify-between items-center mb-6">
                <!-- Flex container untuk judul dan tombol -->
                <h2 class="text-3xl font-extrabold text-gray-800">Daftar Sambutan Kepala Sekolah</h2>
                <!-- Tombol Tambah Sambutan di pojok kanan atas -->
                <a href="{{ route('home.createHero') }}"
                    class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    Create
                </a>
            </div>

            <!-- Tabel Daftar Sambutan Kepala Sekolah -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-600">Foto</th>
                            <th class="px-6 py-3 text-left text-gray-600">Sambutan</th>
                            <th class="px-6 py-3 text-left text-gray-600">Nama Kepala Sekolah</th>
                            <th class="px-6 py-3 text-left text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($heroes as $hero)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <img src="{{ asset(str_replace('public/', 'storage/', $hero->photo)) }}"
                                        alt="Foto Kepala Sekolah" class="w-16 h-16 object-cover rounded-full">
                                </td>
                                <td class="px-6 py-4">{{ $hero->message }}</td>
                                <td class="px-6 py-4">{{ $hero->headmaster_name }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('hero.edit', $hero->id) }}"
                                        class="text-blue-600 hover:text-blue-800">Edit</a> |

                                    <form action="{{ route('hero.destroy', $hero->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus sambutan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 bg-transparent border-none p-0 m-0">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="container mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full">
            <div class="flex justify-between items-center mb-6">
                <!-- Flex container untuk judul dan tombol -->
                <h2 class="text-3xl font-extrabold text-gray-800">Daftar Berita</h2>
                <!-- Tombol Tambah Sambutan di pojok kanan atas -->
                <a href="{{ route('home.createNews') }}"
                    class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    Tambah Berita
                </a>

            </div>


            <!-- Tabel Daftar Berita -->
            <div class="overflow-x-auto mt-8">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-600">Foto</th>
                            <th class="px-6 py-3 text-left text-gray-600">Judul</th>
                            <th class="px-6 py-3 text-left text-gray-600">Tanggal</th>
                            <th class="px-6 py-3 text-left text-gray-600">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <img src="{{ asset(str_replace('public/', 'storage/', $item->photo)) }}" alt="Foto Berita"
                                        class="w-16 h-16 object-cover rounded-full">
                                </td>
                                <td class="px-6 py-4">{{ $item->title }}</td>
                                <td class="px-6 py-4">{{ $item->date }}</td>
                                <td class="px-6 py-4">{{ Str::limit($item->description, 50) }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('home.editNews', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-800">Edit</a> |
                                    <form action="{{ route('home.destroy', $item->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <div class="container mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-extrabold text-gray-800">Kegiatan Civitas Akademik</h2>
                <a href="{{ route('aktivitas.create') }}"
                    class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                    Tambah Aktivitas
                </a>
            </div>

            <div class="overflow-x-auto mt-8">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-600">Foto</th>
                            <th class="px-6 py-3 text-left text-gray-600">Judul</th>
                            <th class="px-6 py-3 text-left text-gray-600">Tanggal</th>
                            <th class="px-6 py-3 text-left text-gray-600">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($aktivitas as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $item->gambar)) }}"
                                            alt="Foto Aktivitas" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold">{{ $item->judul }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">{{ $item->deskripsi }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        {{-- Route edit bawaan resource --}}
                                        <a href="{{ route('aktivitas.edit', $item->id) }}"
                                            class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                                            Edit
                                        </a>
                                        {{-- Route destroy bawaan resource --}}
                                        <form action="{{ route('aktivitas.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection