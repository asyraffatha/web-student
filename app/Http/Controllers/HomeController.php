<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\TekaTekiResult;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
{
    $user = Auth::user();
    $kelas = $user->kelas;

    $materis = Materi::where('kelas', $kelas)
        ->whereNotNull('deadline')
        ->orderBy('deadline')
        ->get();

    $quizzes = Quiz::where('kelas', $kelas)
        ->whereNotNull('deadline')
        ->orderBy('deadline')
        ->get();

    // Ambil guru jika user adalah siswa
    $guru = null;
    if ($user->role === 'siswa') {
        // Sederhananya ambil satu guru saja
        $guru = \App\Models\User::where('role', 'guru')->first(); 
        // Nanti bisa kamu sesuaikan berdasarkan relasi siswa-kelas-guru
    }

    // Progress Teka-Teki
    $totalTekaTeki = \App\Models\Quiz::where('type', 'teka-teki')->count();
    $tekaTekiPassed = 0;
    $canAccessBossQuiz = false;
    if ($user->role === 'siswa') {
        $tekaTekiPassed = \App\Models\TekaTekiResult::where('user_id', $user->id)
            ->where('passed', true)
            ->count();
        $canAccessBossQuiz = ($totalTekaTeki > 0) && ($tekaTekiPassed == $totalTekaTeki);
    }

    return view('home', compact('materis', 'quizzes', 'guru', 'tekaTekiPassed', 'totalTekaTeki', 'canAccessBossQuiz'));
}

}
