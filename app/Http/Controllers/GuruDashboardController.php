<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizResult;

class GuruDashboardController extends Controller
{
    public function index()
{
    $guru = Auth::user();
    $kelasDiampu = $guru->kelasDiampu;

      $totalSiswa = 0;

    foreach ($kelasDiampu as $kelas) {
        $totalSiswa += $kelas->siswa()->count();
    }

    // Ambil ID kelas yang diampu guru
$kelasIds = $kelasDiampu->pluck('id');

// Ambil semua user_id (siswa) dari kelas-kelas tersebut
$siswaIds = [];
foreach ($kelasDiampu as $kelas) {
    $siswaIds = array_merge($siswaIds, $kelas->siswa->pluck('id')->toArray());
}

// Hitung rata-rata skor dari siswa tersebut di quiz_results
$rataRataNilai = QuizResult::whereIn('user_id', $siswaIds)->avg('score');
$rataRataNilai = round($rataRataNilai, 2);
    // Hitung total material
    $totalMaterials = Materi::count();
    $totalQuizzes = Quiz::count();

    // Kirim semua variabel ke view
    return view('Guru.dashboardguru', compact('guru', 'kelasDiampu', 'totalMaterials','totalQuizzes','totalSiswa','rataRataNilai'));
}

public function siswaDiampu()
{
    $guru = Auth::user();
    $kelasDiampu = $guru->kelasDiampu;

    return view('Guru.siswa-diampu', compact('kelasDiampu'));
}
}
