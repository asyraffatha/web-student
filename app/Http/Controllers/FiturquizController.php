<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiturquizController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $kelas = $user->kelas;
        // Ambil quiz harian dan teka-teki yang diberikan guru untuk kelas user
        $quizzes = \App\Models\Quiz::where('kelas', $kelas)->where('type', 'daily')->get();
        $tekaTekis = \App\Models\Quiz::where('kelas', $kelas)->where('type', 'teka-teki')->get();

        // Ambil hasil teka-teki user
        $tekaTekiResults = \App\Models\TekaTekiResult::where('user_id', $user->id)->get()->keyBy('quiz_id');

        // Cek semua teka-teki sudah dikerjakan dan nilai >= 60
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

        // Cek semua quiz harian sudah dikerjakan (opsional: bisa tambahkan pengecekan hasil quiz harian jika ada modelnya)
        // Untuk sekarang, asumsikan quiz harian hanya perlu tampil jumlahnya
        $jumlahQuizHarian = $quizzes->count();
        $jumlahTekaTeki = $tekaTekis->count();

        // Aturan Boss Quiz: semua teka-teki sudah dikerjakan dan nilai >= 60
        $canAccessBossQuiz = ($jumlahTekaTeki > 0) && $allTekaTekiDone && $allTekaTekiPassed;

        $results = \App\Models\QuizResult::where('user_id', $user->id)->get()->keyBy('quiz_id');
        return view('Fiturquiz', compact('jumlahQuizHarian', 'jumlahTekaTeki', 'quizzes', 'tekaTekis', 'tekaTekiResults', 'canAccessBossQuiz', 'results'));
    }
}
