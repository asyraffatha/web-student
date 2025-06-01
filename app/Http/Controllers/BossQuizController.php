<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BossQuizController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalTekaTeki = \App\Models\Quiz::where('type', 'teka-teki')->count();
        $tekaTekiPassed = \App\Models\TekaTekiResult::where('user_id', $user->id)
            ->where('passed', true)
            ->count();
        if ($totalTekaTeki == 0 || $tekaTekiPassed < $totalTekaTeki) {
            return redirect()->route('home')->with('error', 'Selesaikan semua teka-teki untuk mengakses Boss Quiz!');
        }
        return view('boss-quiz.index');
    }
}
