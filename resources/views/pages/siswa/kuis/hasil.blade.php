@extends('layouts.main')
@section('title', 'Hasil Kuis: {{ $quiz->quiz_title }}')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Hasil Kuis: {{ $quiz->quiz_title }}</h4>
            <p>Skor Anda: {{ $score }}/{{ $total }}</p>
        </div>
        <div class="card-body">
            @foreach ($quiz->questions as $index => $question)
    <div class="mb-4">
        <h5>Soal {{ $index + 1 }}: {{ $question->question }}</h5>

        {{-- Tampilkan opsi jawaban --}}
        @php
            $optionKeys = ['A', 'B', 'C', 'D'];
            $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
        @endphp
        <ul>
            @foreach ($optionKeys as $key)
                <li>
                    <strong>{{ $key }}.</strong> {{ $options[$key] ?? 'Pilihan tidak tersedia' }}
                </li>
            @endforeach
        </ul>

        <p><strong>Jawaban Anda:</strong> {{ $answers[$question->id] ?? '-' }}</p>

        {{-- Hanya tampilkan kunci jawaban jika show_answers = 1 --}}
        @if($quiz->show_answers == 1)
            <p><strong>Kunci Jawaban:</strong> {{ $question->answer }}</p>
        @endif

        {{-- Status Benar/Salah tetap ditampilkan --}}
        <p><strong>Status:</strong>
            @if(isset($answers[$question->id]) && $answers[$question->id] === $question->answer)
                <span class="text-success">Benar</span>
            @else
                <span class="text-danger">Salah</span>
            @endif
        </p>
    </div>
@endforeach


            <a href="{{ route('siswa.quiz') }}" class="btn btn-primary">Kembali ke Daftar Kuis</a>
        </div>
    </div>
</div>
@endsection