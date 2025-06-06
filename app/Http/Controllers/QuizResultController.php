<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;

class QuizResultController extends Controller
{
    public function index()
{
    $results = QuizResult::with('quiz')
        ->where('user_id', Auth::id())
        ->orderByDesc('completed_at')
        ->get();

    return view('quiz_results.index', compact('results'));
}
}
