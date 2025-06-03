@extends('layouts.main')
@section('title', 'List Kuis untuk Siswa')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Kuis</h1>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            Kuis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durasi (Menit)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Soal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($quizList as $index => $quiz)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $quiz->quiz_title
                            }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $quiz->quiz_duration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $quiz->questions_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (in_array($quiz->id, $attemptedQuizIds))
                            <button disabled
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-400 cursor-not-allowed rounded-md shadow-sm">
                                Sudah Dikerjakan
                            </button>
                            @else
                            <a href="{{ route('siswa.kuis.kerjakan', $quiz->id) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow-sm transition-colors">
                                Kerjakan
                            </a>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="mt-2 font-medium">Belum ada kuis tersedia</p>
                                <p class="mt-1 text-gray-400">Cek kembali nanti untuk kuis baru!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection