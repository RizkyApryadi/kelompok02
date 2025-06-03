@extends('layouts.main')
@section('title', 'List Admin')

@section('content')
<section class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Konten About</h1>

    <a href="{{ route('about.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">+ Tambah Konten</a>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($abouts as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-pre-line text-sm text-gray-700">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi), 100) }}
                    </td>
                    <td class="px-6 py-4 text-sm flex gap-2">
                        <a href="{{ route('about.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('about.destroy', $item->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:underline bg-transparent border-none p-0 m-0 delete-button">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($abouts->isEmpty())
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
