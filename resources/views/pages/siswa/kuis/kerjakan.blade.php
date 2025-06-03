@extends('layouts.main')
@section('title', 'Kerjakan Kuis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $quiz->quiz_title }}</h1>
        <p class="text-gray-600 mb-6">{{ $quiz->quiz_description }}</p>

        {{-- Tampilkan timer jika quiz_duration > 0 --}}
        @if ($quiz->quiz_duration > 0)
        <div class="text-right mb-4 text-red-600 font-semibold text-lg" id="countdown">
            Sisa Waktu: <span id="timer"></span>
        </div>
        @endif

        {{-- Tampilkan error jika ada --}}
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
            <h4 class="font-semibold text-red-800">Terjadi Kesalahan</h4>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('siswa.kuis.submit', $quiz->id) }}" method="POST" class="space-y-6" id="quiz-form">
            @csrf
            @foreach ($quiz->questions as $index => $question)
            <div class="border-b border-gray-200 pb-4">
                <p class="text-lg font-semibold text-gray-900 mb-3">
                    {{ $index + 1 }}. {{ $question->question }}
                </p>
                <div class="space-y-2">
                    @php
                    $optionKeys = ['A', 'B', 'C', 'D'];
                    $options = is_array($question->options) && isset($question->options['A'])
                    ? $question->options
                    : array_combine($optionKeys, array_pad((array) $question->options, 4, 'Pilihan tidak tersedia'));
                    @endphp
                    @foreach ($optionKeys as $key)
                    <div class="flex items-center">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}"
                            id="{{ $question->id }}_{{ $key }}"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="{{ $question->id }}_{{ $key }}"
                            class="ml-3 block text-sm text-gray-700 hover:text-gray-900 cursor-pointer">
                            {{ $key }}. {{ $options[$key] ?? 'Pilihan tidak tersedia' }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="mt-6">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    Kirim Jawaban
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script Timer --}}
@if ($quiz->quiz_duration > 0)
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let duration = {{ $quiz->quiz_duration }} * 60; // dalam detik
            const timerDisplay = document.getElementById('timer');
            const form = document.getElementById('quiz-form');

            function updateTimer() {
                const minutes = Math.floor(duration / 60);
                const seconds = duration % 60;
                timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

                if (duration <= 0) {
                    clearInterval(countdown);
                    // SweetAlert muncul
                    Swal.fire({
                        title: 'Waktu Habis!',
                        text: 'Jawaban kamu akan dikirim otomatis.',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then(() => {
                        form.submit();
                    });
                }

                duration--;
            }

            const countdown = setInterval(updateTimer, 1000);
            updateTimer();
</script>
@endif
@endsection