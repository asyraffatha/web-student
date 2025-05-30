<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
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

    return view('home', compact('materis', 'quizzes', 'guru'));
}

}
