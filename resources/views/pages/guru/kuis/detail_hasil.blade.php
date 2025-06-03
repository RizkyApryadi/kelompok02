@extends('layouts.main')
@section('title', 'Detail Hasil Kuis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Hasil Pengerjaan: {{ $quiz->quiz_title }}</h1>

    @if($attempts->isEmpty())
        <p class="text-gray-600">Belum ada siswa yang mengerjakan kuis ini.</p>
    @else
        <div class="bg-white p-6 rounded shadow overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nama Siswa</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Skor</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Submit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attempts as $index => $attempt)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attempt->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $attempt->score }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y H:i') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <a href="{{ route('pages.guru.kuis.index') }}"
       class="inline-block mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Kembali ke Daftar Kuis
    </a>
</div>
@endsection
