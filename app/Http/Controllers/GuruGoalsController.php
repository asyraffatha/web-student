<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\QuizResult;

class GuruGoalsController extends Controller
{
    public function index(Request $request)
    {
        $guru = Auth::user();
        $kelasDiampu = $guru->kelasDiampu;
        $kelasTerpilih = $request->get('kelas') ?? ($kelasDiampu->first()->nama ?? null);

        $tipeQuiz = [
            'daily' => 'Quiz Harian',
            'teka-teki' => 'Teka-Teki',
            'boss' => 'Boss Quiz',
        ];
        $tipeQuizTerpilih = $request->get('tipe') ?? 'daily';

        $siswa = collect();
        $quizzes = collect();
        $nilai = [];

        if ($kelasTerpilih) {
            $kelas = Kelas::where('nama', $kelasTerpilih)->first();
            $siswa = $kelas ? $kelas->siswa : collect();
            $quizzes = $kelas
                ? Quiz::where('kelas', $kelas->id)->where('type', $tipeQuizTerpilih)->get()
                : collect();

            foreach ($siswa as $s) {
                foreach ($quizzes as $q) {
                    $result = QuizResult::where('user_id', $s->id)->where('quiz_id', $q->id)->first();
                    $nilai[$s->id][$q->id] = $result ? $result->score : null;
            }
        }
    }

        return view('Guru.goals', compact('kelasDiampu', 'kelasTerpilih', 'siswa', 'quizzes', 'nilai', 'tipeQuiz', 'tipeQuizTerpilih'));
    }
} 