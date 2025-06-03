<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua kuis dan hitung jumlah soal
        $quizList = Quiz::withCount('questions')->get();

        // Ambil semua quiz_id yang sudah dikerjakan user dari tabel quiz_attempts
        $attemptedQuizIds = QuizAttempt::where('user_id', $userId)->pluck('quiz_id')->toArray();

        return view('pages.guru.kuis.index', compact('quizList', 'attemptedQuizIds'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        return view('pages.guru.kuis.create', compact('kelasList'));
    }

    public function siswa()
    {
        $user = auth()->user();

        if ($user->siswa && $user->siswa->kelas_id) {
            $kelasId = $user->siswa->kelas_id;

            $quizList = Quiz::withCount('questions')
                ->where('target_class', $kelasId)
                ->get();

            $attemptedQuizIds = QuizAttempt::where('user_id', $user->id)->pluck('quiz_id')->toArray();

            return view('pages.siswa.kuis.index', compact('quizList', 'attemptedQuizIds'));
        }

        return redirect()->back()->with('error', 'Kelas siswa tidak ditemukan.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_title' => 'required|string|max:255',
            'quiz_description' => 'required|string',
            'quiz_duration' => 'required|integer',
            'target_class' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:4',
            'questions.*.answer' => 'required|string|in:A,B,C,D',
        ]);

        $quiz = Quiz::create($request->only(['quiz_title', 'quiz_description', 'quiz_duration', 'show_answers', 'target_class']));

        foreach ($request->input('questions') as $questionData) {
            $options = [
                'A' => $questionData['options'][0],
                'B' => $questionData['options'][1],
                'C' => $questionData['options'][2],
                'D' => $questionData['options'][3],
            ];
            $quiz->questions()->create([
                'question' => $questionData['question'],
                'options' => $options,
                'answer' => $questionData['answer'],
            ]);
        }

        return redirect()->route('pages.guru.kuis.index')->with('success', 'Kuis berhasil dibuat!');
    }

    public function kerjakan($id)
    {
        $userId = Auth::id();

        $alreadyAttempted = QuizAttempt::where('user_id', $userId)
            ->where('quiz_id', $id)
            ->exists();

        if ($alreadyAttempted) {
            return redirect()->route('pages.siswa.kuis.index')->with('error', 'Anda sudah mengerjakan kuis ini.');
        }

        $quiz = Quiz::with('questions')->findOrFail($id);

        return view('pages.siswa.kuis.kerjakan', compact('quiz'));
    }

    public function submit(Request $request, $quizId)
    {
        try {
            $userId = Auth::id();
            $quiz = Quiz::with('questions')->findOrFail($quizId);

            $alreadyAttempted = QuizAttempt::where('user_id', $userId)
                ->where('quiz_id', $quizId)
                ->exists();

            if ($alreadyAttempted) {
                return redirect()->route('pages.siswa.kuis.index')->with('error', 'Anda sudah mengerjakan kuis ini.');
            }

            $request->validate([
                'answers' => 'required|array',
                'answers.*' => 'nullable|string|in:A,B,C,D',
            ]);

            $score = 0;
            $total = $quiz->questions->count();

            foreach ($quiz->questions as $question) {
                if (
                    isset($request->answers[$question->id]) &&
                    $request->answers[$question->id] === $question->answer
                ) {
                    $score++;
                }
            }

            QuizAttempt::create([
                'user_id' => $userId,
                'quiz_id' => $quizId,
                'score' => $score,
                'submitted_at' => now(),
                'completed_at' => now(),
            ]);

            return view('pages.siswa.kuis.hasil', [
                'quiz' => $quiz,
                'score' => $score,
                'total' => $total,
                'answers' => $request->answers,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses kuis: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $kelasList = Kelas::all();
        return view('pages.guru.kuis.edit', compact('quiz', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quiz_title' => 'required|string|max:255',
            'quiz_description' => 'required|string',
            'quiz_duration' => 'required|integer',
            'target_class' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:4',
            'questions.*.answer' => 'required|string|in:A,B,C,D',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->only(['quiz_title', 'quiz_description', 'quiz_duration', 'show_answers', 'target_class']));

        $quiz->questions()->delete();

        foreach ($request->input('questions') as $questionData) {
            $options = [
                'A' => $questionData['options'][0],
                'B' => $questionData['options'][1],
                'C' => $questionData['options'][2],
                'D' => $questionData['options'][3],
            ];
            $quiz->questions()->create([
                'question' => $questionData['question'],
                'options' => $options,
                'answer' => $questionData['answer'],
            ]);
        }

        return redirect()->route('pages.guru.kuis.index')->with('success', 'Kuis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('pages.guru.kuis.index')->with('success', 'Kuis berhasil dihapus!');
    }

    // Tambahan: method untuk menampilkan hasil kuis (untuk guru)
    public function hasil($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Ambil semua attempt dari siswa yang mengerjakan quiz ini beserta relasi user
        $attempts = QuizAttempt::where('quiz_id', $quizId)
            ->with('user')
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('pages.guru.kuis.detail_hasil', compact('quiz', 'attempts'));
    }
}