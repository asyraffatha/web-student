<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiturquizController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $kelasNama = $user->kelas;
        $kelasObj = \App\Models\Kelas::where('nama', $kelasNama)->first();
        $kelasId = $kelasObj ? $kelasObj->id : null;
            // Ambil quiz harian dan teka-teki yang diberikan guru untuk kelas user
            $quizzes = \App\Models\Quiz::where('kelas', $kelasId)->where('type', 'daily')->get();
            $tekaTekis = \App\Models\Quiz::where('kelas', $kelasId)->where('type', 'teka-teki')->get();

            // Ambil hasil teka-teki user dari QuizResult (bukan TekaTekiResult)
            $tekaTekiResults = \App\Models\QuizResult::where('user_id', $user->id)
                ->whereIn('quiz_id', $tekaTekis->pluck('id'))
                ->get()->keyBy('quiz_id');

        // Syarat: semua teka-teki harus sudah dikerjakan dan semua nilai >= 60
        $allTekaTekiDone = true;
        $allTekaTekiPassed = true;
        foreach ($tekaTekis as $tekaTeki) {
            $result = $tekaTekiResults->get($tekaTeki->id);
            if (!$result) {
                $allTekaTekiDone = false;
                $allTekaTekiPassed = false;
                break;
            }
            if ($result->score < 60) {
                $allTekaTekiPassed = false;
            }
        }
        $canAccessBossQuiz = ($tekaTekis->count() > 0) && $allTekaTekiDone && $allTekaTekiPassed;

        // Untuk Blade: passing info remedial teka-teki (max 2 attempt)
        $tekaTekiRemedialCount = [];
        foreach ($tekaTekis as $tekaTeki) {
            $tekaTekiRemedialCount[$tekaTeki->id] = \App\Models\QuizResult::where('user_id', $user->id)->where('quiz_id', $tekaTeki->id)->count();
        }

        $results = \App\Models\QuizResult::where('user_id', $user->id)->get()->keyBy('quiz_id');

        // Ambil Boss Quiz Mingguan
        $bossQuizzes = \App\Models\Quiz::where('kelas', $kelasId)->where('type', 'boss')->get();
        $bossQuizResults = $results->only($bossQuizzes->pluck('id')->all());
        $jumlahBossQuiz = $bossQuizzes->count();

        $jumlahQuizHarian = $quizzes->count();
        $jumlahTekaTeki = $tekaTekis->count();

        return view('Fiturquiz', compact(
            'jumlahQuizHarian',
            'jumlahTekaTeki',
            'quizzes',
            'tekaTekis',
            'tekaTekiResults',
            'canAccessBossQuiz',
            'results',
            'bossQuizzes',
            'bossQuizResults',
            'jumlahBossQuiz',
            'tekaTekiRemedialCount'
        ));
    }
}
