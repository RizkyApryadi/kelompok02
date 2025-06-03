<!-- resources/views/quiz/create.blade.php -->
@extends('layouts.main')
@section('title', 'Tambah Kuis')

@section('content')
<div class="container mt-4">
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf

        <!-- Informasi Umum Kuis -->
        <div class="card mb-4">
            <div class="card-header">Informasi Kuis</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="quiz_title" class="form-label">Judul Kuis</label>
                    <input type="text" class="form-control" id="quiz_title" name="quiz_title"
                        placeholder=" Masukkan judul kuis" required>
                </div>
                <div class="mb-3">
                    <label for="quiz_description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="quiz_description" name="quiz_description" rows="3"
                        placeholder="Deskripsikan kuis..." required></textarea>
                </div>
                <div class="mb-3">
                    <label for="quiz_duration" class="form-label">Durasi (menit)</label>
                    <input type="number" class="form-control" id="quiz_duration" name="quiz_duration"
                        placeholder="Contoh: 30" min="1" required>
                </div>

                @if($kelasList->isEmpty())
                <div class="alert alert-warning">
                    Anda belum memiliki kelas. Silakan hubungi admin untuk penugasan kelas.
                </div>
                @else
                <div class="form-group">
                    <label for="target_class">Kelas Tujuan</label>
                    <select id="target_class" name="target_class" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                @endif



                <div class="mb-3">
                    <label class="form-label">Tampilkan Kunci Jawaban Setelah Submit?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="show_answers" value="1">
                        <label class="form-check-label" for="show_yes">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="show_answers" value="0" checked>
                        <label class="form-check-label" for="show_no">Tidak</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Soal -->
        <div id="question-container">
            <div class="card mb-4">
                <div class="card-header">Soal 1</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="question_1" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" name="questions[0][question]"
                            placeholder="Masukkan pertanyaan" required>
                    </div>
                    <label class="form-label">Pilihan Jawaban</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="questions[0][options][]" placeholder="Pilihan A"
                            required>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="questions[0][options][]" placeholder="Pilihan B"
                            required>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="questions[0][options][]" placeholder="Pilihan C"
                            required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="questions[0][options][]" placeholder="Pilihan D"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="answer_1" class="form-label">Kunci Jawaban (A/B/C/D)</label>
                        <select name="questions[0][answer]" class="form-control" required>
                            <option value="">-- Pilih Kunci Jawaban --</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Soal -->
        <button type="button" id="add-question" class="btn btn-secondary mb-3">+ Tambah Soal</button>

        <!-- Tombol Simpan Kuis -->
        <button type="submit" class="btn btn-primary">Simpan Kuis</button>
    </form>
</div>

<script>
    let questionIndex = 1;
    document.getElementById('add-question').addEventListener('click', function() {
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('card', 'mb-4');
        newQuestion.innerHTML = `
            <div class="card-header">Soal ${questionIndex + 1}</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="question_${questionIndex}" class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" name="questions[${questionIndex}][question]" placeholder="Masukkan pertanyaan" required>
                </div>
                <label class="form-label">Pilihan Jawaban</label>
                <div class="mb-2">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Pilihan A" required>
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Pilihan B" required>
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Pilihan C" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Pilihan D" required>
                </div>

                <div class="mb-3">
                    <label for="answer_${questionIndex}" class="form-label">Kunci Jawaban (A/B/C/D)</label>
                    <select name="questions[${questionIndex}][answer]" class="form-control" required>
                        <option value="">-- Pilih Kunci Jawaban --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        </div>`;
        document.getElementById('question-container').appendChild(newQuestion);
        questionIndex++;
    });
</script>
@endsection