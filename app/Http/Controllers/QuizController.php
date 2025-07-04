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
        $user = Auth::user();
        $kelasNama = $user->kelas;
        $kelasObj = \App\Models\Kelas::where('nama', $kelasNama)->first();
        $kelasId = $kelasObj ? $kelasObj->id : null;

        $quizzes = Quiz::where('kelas', $kelasId)->get();
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

        // Handle Teka-teki quiz retry logic
        if ($quiz->type === 'teka-teki') {
            if ($result) {
                // If user has failed and hasn't used retry
                if ($result->score < 60 && !$result->retry_attempted) {
                    return view('quizzes.show', compact('quiz', 'result'));
                }
                // If user has already used retry or passed
                if ($result->retry_attempted || $result->score >= 60) {
                    return redirect()->route('quizzes.index')->with('error', 'Quiz ini hanya bisa dikerjakan 1 kali.');
                }
            }
        }
        // Handle Boss quiz access
        else if ($quiz->type === 'boss') {
            // Check if user has passed all Teka-teki quizzes
            $tekaTekis = Quiz::where('type', 'teka-teki')->where('kelas', $user->kelas)->get();
            $allTekaTekiPassed = true;
            foreach ($tekaTekis as $tekaTeki) {
                $tekaTekiResult = QuizResult::where('user_id', $user->id)
                    ->where('quiz_id', $tekaTeki->id)
                    ->first();
                if (!$tekaTekiResult || $tekaTekiResult->score <= $tekaTeki->passing_score) {
                    $allTekaTekiPassed = false;
                    break;
                }
            }
            if (!$allTekaTekiPassed) {
                return redirect()->route('quizzes.index')->with('error', 'Selesaikan semua Teka-teki dengan skor LEBIH DARI passing score untuk mengakses Boss Quiz!');
            }
            // If user has already attempted boss quiz
            if ($result) {
                return redirect()->route('quizzes.index')->with('error', 'Boss Quiz hanya bisa dikerjakan 1 kali.');
            }
        }
        // Handle Daily quiz
        else if ($quiz->type === 'daily') {
            if ($result) {
                if ($result->attempts >= 3) {
                    return redirect()->route('quizzes.index')->with('error', 'Anda telah mencapai batas maksimal percobaan (3x).');
                }
                if ($result->passed) {
                    return redirect()->route('quizzes.index')->with('error', 'Anda sudah lulus quiz ini.');
                }
            }
        }

        return view('quizzes.show', compact('quiz', 'result'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $user = Auth::user();
        $result = QuizResult::where('user_id', $user->id)->where('quiz_id', $quiz->id)->first();

        // Handle Teka-teki quiz retry logic
        if ($quiz->type === 'teka-teki') {
            if ($result) {
                // If user has already used retry or passed
                if ($result->retry_attempted || $result->score >= 60) {
                    return redirect()->route('quizzes.index')->with('error', 'Quiz ini hanya bisa dikerjakan 1 kali.');
                }
            }
        }
        // Handle Boss quiz access
        else if ($quiz->type === 'boss') {
            // Check if user has passed all Teka-teki quizzes
            $tekaTekis = Quiz::where('type', 'teka-teki')->where('kelas', $user->kelas)->get();
            $allTekaTekiPassed = true;
            foreach ($tekaTekis as $tekaTeki) {
                $tekaTekiResult = QuizResult::where('user_id', $user->id)
                    ->where('quiz_id', $tekaTeki->id)
                    ->first();
                if (!$tekaTekiResult || $tekaTekiResult->score <= $tekaTeki->passing_score) {
                    $allTekaTekiPassed = false;
                    break;
                }
            }
            if (!$allTekaTekiPassed) {
                return redirect()->route('quizzes.index')->with('error', 'Selesaikan semua Teka-teki dengan skor LEBIH DARI passing score untuk mengakses Boss Quiz!');
            }
            // If user has already attempted boss quiz
            if ($result) {
                return redirect()->route('quizzes.index')->with('error', 'Boss Quiz hanya bisa dikerjakan 1 kali.');
            }
        }
        // Handle Daily quiz
        else if ($quiz->type === 'daily' && $result) {
            if ($result->attempts >= 3) {
                return redirect()->route('quizzes.index')->with('error', 'Anda telah mencapai batas maksimal percobaan (3x).');
            }
        }

        $score = 0;
        $pointPerQuestion = 100 / $quiz->questions->count();
        foreach ($quiz->questions as $question) {
            if ($request->input('answers.' . $question->id) == $question->answer) {
                $score += $pointPerQuestion;
            }
        }
        $passed = $score >= $quiz->passing_score;

        // Handle retry attempt for Teka-teki
        if ($quiz->type === 'teka-teki' && $result && $request->has('is_retry')) {
            $result->update([
                'score' => $score,
                'passed' => $passed,
                'retry_attempted' => true,
                'completed_at' => now()
            ]);
        } else if ($quiz->type === 'daily' && $result) {
            // Update daily quiz result with incremented attempts
            $result->update([
                'score' => $score,
                'passed' => $passed,
                'attempts' => $result->attempts + 1,
                'completed_at' => now()
            ]);
        } else {
            QuizResult::updateOrCreate(
                ['user_id' => $user->id, 'quiz_id' => $quiz->id],
                [
                    'score' => $score,
                    'passed' => $passed,
                    'retry_attempted' => false,
                    'attempts' => 1,
                    'completed_at' => now()
                ]
            );
        }

        return view('quizzes.result', compact('score', 'quiz', 'result'));
    }

    public function create()
    {
        $user = Auth::user();
        $kelasDiampu = $user->kelasDiampu;
    return view('Guru.quizcreate', compact('kelasDiampu')); 
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
        $guru = Auth::user();
        $kelasDiampu = $guru->kelasDiampu; // relasi ke kelas yang diampu guru
        $quizzes = Quiz::withCount('questions')
            ->whereIn('kelas', $kelasDiampu->pluck('id'))
            ->get();
    return view('Guru.quizlist', compact('quizzes', 'kelasDiampu'));
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
    return view('Guru.quizpreview', compact('quiz'));
    }
}
