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
    return view('guru.dashboardguru', compact('guru', 'kelasDiampu', 'totalMaterials','totalQuizzes'));
}

}
