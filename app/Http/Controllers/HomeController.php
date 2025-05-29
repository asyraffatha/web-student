<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
{
    $kelas = Auth::user()->kelas;

    $materis = Materi::where('kelas', $kelas)
        ->whereNotNull('deadline')
        ->orderBy('deadline')
        ->get();
        

    $quizzes = Quiz::where('kelas', $kelas)
        ->whereNotNull('deadline')
        ->orderBy('deadline')
        ->get();

    return view('home', compact('materis', 'quizzes')); // ini penting!
}
}
