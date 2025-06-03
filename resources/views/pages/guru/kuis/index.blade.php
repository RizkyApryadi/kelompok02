@extends('layouts.main')
@section('title', 'Daftar Kuis')

@section('content')
<div class="container mt-4">

    <!-- Tombol tambah kuis -->
    <a href="{{route('quis.create')}}" class="btn btn-primary mb-3">+ Tambah Kuis</a>

    <!-- Tabel daftar kuis -->
   <!-- Tabel daftar kuis -->
<div class="table-responsive">
    <div class="bg-white p-4 rounded shadow">
        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Kuis</th>
                    <th>Durasi (menit)</th>
                    <th>Tampilkan Jawaban</th>
                    <th>Jumlah Soal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quizList as $index => $quiz)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $quiz->quiz_title }}</td>
                    <td>{{ $quiz->quiz_duration }}</td>
                    <td>{{ $quiz->show_answers ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $quiz->questions_count }}</td>
                    <td>
                        <a href="{{ route('quiz.hasil', $quiz->id) }}" class="btn btn-primary">Lihat Hasil</a>
                        <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada kuis</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection