<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $materis = Materi::where('kelas', $user->kelas)
                     ->orderBy('created_at', 'desc')
                     ->take(5)
                     ->get();

    $quizzes = Quiz::where('kelas', $user->kelas)
                   ->orderBy('created_at', 'desc')
                   ->take(5)
                   ->get();

    return view('home', compact('materis', 'quizzes'));
}
}
