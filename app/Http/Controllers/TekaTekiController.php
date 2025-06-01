<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TekaTekiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalTekaTeki = \App\Models\Quiz::where('type', 'teka-teki')->count();
        $tekaTekiPassed = \App\Models\TekaTekiResult::where('user_id', $user->id)
            ->where('passed', true)
            ->count();
        $canAccessBossQuiz = ($totalTekaTeki > 0) && ($tekaTekiPassed == $totalTekaTeki);
        return view('teka-teki.index', compact('tekaTekiPassed', 'totalTekaTeki', 'canAccessBossQuiz'));
    }
}
