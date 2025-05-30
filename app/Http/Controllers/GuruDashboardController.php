<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Quiz;

class GuruDashboardController extends Controller
{
    public function index()
{
    $guru = Auth::user();
    $kelasDiampu = $guru->kelasDiampu;

    // Hitung total material
    $totalMaterials = Materi::count();
    $totalQuizzes = Quiz::count();

    // Kirim semua variabel ke view
    return view('Guru.dashboardguru', compact('guru', 'kelasDiampu', 'totalMaterials','totalQuizzes'));
}

public function siswaDiampu()
{
    $guru = Auth::user();
    $kelasDiampu = $guru->kelasDiampu;

    return view('Guru.siswa-diampu', compact('kelasDiampu'));
}
}
