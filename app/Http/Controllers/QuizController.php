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
        $quiz = Quiz::with(['questions' => function($query) {
            $query->orderBy('id', 'asc');
        }])->findOrFail($id);
        $user = Auth::user();
        $result = QuizResult::where('user_id', $user->id)->where('quiz_id', $quiz->id)->first();
        // Batasi 1x untuk teka-teki dan boss
        if (($quiz->type === 'teka-teki' || $quiz->type === 'boss') && $result) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz ini hanya bisa dikerjakan 1 kali.');
        }
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, $id)
    {
    $quiz = Quiz::with('questions')->findOrFail($id);
        $user = Auth::user();
        $result = QuizResult::where('user_id', $user->id)->where('quiz_id', $quiz->id)->first();
        // Batasi 1x untuk teka-teki dan boss
        if (($quiz->type === 'teka-teki' || $quiz->type === 'boss') && $result) {
            return redirect()->route('quizzes.index')->with('error', 'Quiz ini hanya bisa dikerjakan 1 kali.');
        }
    $score = 0;
    $pointPerQuestion = 100 / $quiz->questions->count();
    foreach ($quiz->questions as $question) {
        if ($request->input('answers.' . $question->id) == $question->answer) {
            $score += $pointPerQuestion;
        }
    }
    $passed = $score >= $quiz->passing_score;
QuizResult::updateOrCreate(
            ['user_id' => $user->id, 'quiz_id' => $quiz->id],
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
        $kelasDiampu = null;
        if (Auth::user()->isGuru()) {
            $kelasDiampu = Auth::user()->kelasDiampu;
        }
        return view('guru.quizcreate', compact('kelasDiampu'));
    }

    public function store(Request $request)
    {
    $request->validate([
    'title' => 'required|string|max:255',
    'kelas' => 'required|string',
    'type' => 'required|string|in:daily,teka-teki,boss',
    'passing_score' => 'required|numeric|min:0|max:100',
    'questions' => 'required|array|min:1',
    'questions.*.question' => 'required|string',
    'questions.*.options' => 'required|array|size:4',
    'questions.*.answer' => 'required|string|in:A,B,C,D',
    'questions.*.image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
    'questions.*.video' => 'nullable|file|mimes:mp4,webm,ogg|max:10240',
    'questions.*.options_images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
    'deadline' => 'nullable|date',
]);

    $quiz = Quiz::create([
        'title' => $request->title,
        'kelas' => $request->kelas,
        'type' => $request->type,
        'passing_score' => $request->passing_score,
        'deadline' => $request->deadline,
    ]);

    foreach ($request->questions as $q) {
        $imagePath = null;
        $videoPath = null;
        $optionsImages = [];

        // Handle question image
        if (isset($q['image']) && $q['image']->isValid()) {
            $imagePath = $q['image']->store('question_images', 'public');
        }

        // Handle question video
        if (isset($q['video']) && $q['video']->isValid()) {
            $videoPath = $q['video']->store('question_videos', 'public');
        }

        // Handle options images
        if (isset($q['options_images'])) {
            foreach ($q['options_images'] as $index => $image) {
                if ($image && $image->isValid()) {
                    $optionsImages[$index] = $image->store('option_images', 'public');
                }
            }
        }

        Question::create([
            'quiz_id' => $quiz->id,
            'question' => $q['question'],
            'options' => $q['options'],
            'answer' => strtoupper($q['answer']),
            'image' => $imagePath,
            'video' => $videoPath,
            'options_images' => $optionsImages,
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
