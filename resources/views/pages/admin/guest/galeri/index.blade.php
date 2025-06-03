@extends('layouts.main')
@section('title', 'List Admin')

@section('content')
    <br><br>
    <div style="background-color: rgb(249, 249, 249); padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); margin-top: 20px;">

        <!-- Prestasi Akademik -->
        <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 24px; margin-bottom: 48px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h2 style="font-size: 24px; font-weight: bold; color: #2d3748; text-align: left;">Prestasi Akademik</h2>
                <a href="{{ route('prestasi.create.prestasi.akademik') }}">
                    <button style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer;">
                        Tambah Data
                    </button>
                </a>
            </div>
            <div style="overflow-x: auto;">
                <table style="min-width: 100%; border: 1px solid #d1d5db; table-layout: fixed; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f7fafc;">
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 10%;">No</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 25%;">Nama Lengkap</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 15%;">Tanggal Pelaksanaan</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 15%;">Kejuruan</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 15%;">Tingkat</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 20%;">Penyelenggara</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px; width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $index => $item)
                            <tr style="transition: background-color 0.3s;">
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $item->nama_lengkap }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d M Y') }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $item->kejuruan }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $item->tingkat }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $item->penyelenggara }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; display: flex; justify-content: flex-end;">
                                    <a href="{{ route('prestasi-akademik.edit', $item->id) }}"
                                        style="padding: 4px 8px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; margin-right: 4px;">
                                        Edit
                                    </a>
                                    <form action="{{ route('prestasi-akademik.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 4px 8px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Prestasi Non-Akademik -->
        <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 24px; margin-bottom: 48px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <h2 style="font-size: 24px; font-weight: bold; color: #2d3748; text-align: left;">Prestasi Non-Akademik</h2>
                <a href="{{ route('prestasi-non-akademik.create') }}">
                    <button style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer;">
                        Tambah Data
                    </button>
                </a>
            </div>
            <div style="overflow-x: auto;">
                <table style="min-width: 100%; border: 1px solid #d1d5db; table-layout: fixed; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f7fafc;">
                            <th style="border: 1px solid #d1d5db; padding: 8px;">No</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Nama Lengkap</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Tanggal Pelaksanaan</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Kejuruan</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Tingkat</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Penyelenggara</th>
                            <th style="border: 1px solid #d1d5db; padding: 8px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestasiNon as $index => $pre)
                            <tr>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $index + 1 }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $pre->nama_lengkap }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ \Carbon\Carbon::parse($pre->tanggal_pelaksanaan)->format('d M Y') }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $pre->kejuruan }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $pre->tingkat }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px;">{{ $pre->penyelenggara }}</td>
                                <td style="border: 1px solid #d1d5db; padding: 8px; display: flex; gap: 4px; justify-content: center;">
                                    <a href="{{ route('prestasi-non-akademik.edit', $pre->id) }}"
                                        style="padding: 4px 8px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">
                                        Edit
                                    </a>
                                    <form action="{{ route('prestasi-non-akademik.destroy', $pre->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 4px 8px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('script')
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
  