@extends('layouts.main')
@section('title', 'Daftar Alumni')

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Daftar Alumni</h2>
        <a href="{{ route('alumni.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">
            Tambah Alumni
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Foto</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Angkatan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Keterangan</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($alumnis as $alumni)
                <tr>
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/foto_alumni/' . $alumni->foto) }}" alt="Foto Alumni" class="w-16 h-16 object-cover rounded-md" />
                    </td>
                    <td class="px-4 py-3 text-gray-800">{{ $alumni->nama }}</td>
                    <td class="px-4 py-3 text-gray-800">{{ $alumni->angkatan }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $alumni->keterangan }}</td>
                    <td class="px-4 py-3">
                        <div class="flex space-x-2">
                            <a href="{{ route('alumni.edit', $alumni->id) }}" class="text-blue-500 hover:underline text-sm">Edit</a>
                            
                            <form action="{{ route('alumni.destroy', $alumni->id) }}" method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Hapus</button>
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
