<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class QuizController extends Controller
{
    public function index()
    {
   $user = Auth::user(); // lebih aman diintelisense dan bisa digunakan ulang
    $quizzes = Quiz::where('kelas', $user->kelas)->get();
    $results = QuizResult::where('user_id', $user->id)->get()->keyBy('quiz_id');

    return view('quizzes.index', compact('quizzes', 'results'));
    }

    public function show($id)
{
    $quiz = Quiz::with('questions')->findOrFail($id);

    // Cek apakah ada quiz sebelumnya di kelas yang sama
    $previousQuiz = Quiz::where('id', '<', $quiz->id)
        ->where('kelas', $quiz->kelas)
        ->orderBy('id', 'desc')
        ->first();

    // Jika ada quiz sebelumnya, cek apakah user sudah lulus
    if ($previousQuiz) {
        $previousResult = QuizResult::where('user_id', Auth::id())
            ->where('quiz_id', $previousQuiz->id)
            ->where('passed', true)
            ->first();

        if (!$previousResult) {
            return redirect()->route('quizzes.index')->with('error', 'Selesaikan dan lulus kuis sebelumnya ('. $previousQuiz->title .') terlebih dahulu!');
        }
    }

    return view('quizzes.show', compact('quiz'));
}


    public function submit(Request $request, $id)
    {
    $quiz = Quiz::with('questions')->findOrFail($id);
    $score = 0;
    $pointPerQuestion = 100 / $quiz->questions->count();

    foreach ($quiz->questions as $question) {
        if ($request->input('answers.' . $question->id) == $question->answer) {
            $score += $pointPerQuestion;
        }
    }

    $passed = $score >= $quiz->passing_score;

QuizResult::updateOrCreate(
    ['user_id' => Auth::id(), 'quiz_id' => $quiz->id],
    [
        'score' => $score,
        'passed' => $passed,
        'completed_at' => now()
    ]
);

    return view('quizzes.result', compact('score', 'quiz'));
    }

    public function create()
    {
    return view('guru.quizcreate');
    }

    public function store(Request $request)
    {
    $request->validate([
    'title' => 'required|string|max:255',
    'kelas' => 'required|string',
    'passing_score' => 'required|numeric|min:0|max:100',
    'questions' => 'required|array|min:1',
    'questions.*.question' => 'required|string',
    'questions.*.options' => 'required|array|size:4',
    'questions.*.answer' => 'required|string|in:A,B,C,D',
]);

    $quiz = Quiz::create([
        'title' => $request->title,
        'kelas' => $request->kelas,
        'passing_score' => $request->passing_score,
        'deadline' => $request->deadline,
    ]);

    foreach ($request->questions as $q) {
        Question::create([
            'quiz_id' => $quiz->id,
            'question' => $q['question'],
            'options' => $q['options'],
            'answer' => strtoupper($q['answer']),
        ]);
    }

    return redirect()->route('quiz.create')->with('success', 'Quiz berhasil dibuat!');
    }

    public function listForGuru()
    {
    $quizzes = Quiz::withCount('questions')->get();
    return view('guru.quizlist', compact('quizzes'));
    }

    public function destroy($id)
    {
    $quiz = Quiz::findOrFail($id);

    // Otomatis menghapus questions & results karena relasi cascade
    $quiz->delete();

    return redirect()->route('quiz.list')->with('success', 'Quiz berhasil dihapus.');
    }

    public function preview($id)
    {
    $quiz = Quiz::with('questions')->findOrFail($id);
    return view('guru.quizpreview', compact('quiz'));
    }
}
