@extends('layouts.main')
@section('title', 'List Fasilitas')

@section('content')
    <div class="w-full bg-white py-10 px-6">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold">Daftar Fasilitas</h2>
            <a href="{{ route('fasilitas.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
                Tambah Fasilitas
            </a>
        </div>


        {{-- List Fasilitas dalam Bentuk Tabel --}}
        <div class="overflow-x-auto mt-8">
            <table class="min-w-full table-auto border-separate border-spacing-0 border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 border-b border-gray-300">Nama
                            Fasilitas</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 border-b border-gray-300">Foto
                            Fasilitas</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 border-b border-gray-300">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 border-b border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas as $item)
                        <tr class="border-b border-gray-300 hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto {{ $item->nama }}"
                                        class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->deskripsi }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-4">
                                    <a href="{{ route('fasilitas.edit', $item->id) }}"
                                        class="text-blue-500 text-sm font-medium hover:underline">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('fasilitas.destroy', $item->id) }}"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus fasilitas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 text-sm font-medium hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')

@endpush