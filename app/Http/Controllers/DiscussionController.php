<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'guru') {
        // Guru: lihat siswa di kelas yang diampu
        $kelasGuru = $user->kelasDiampu->pluck('nama');

        $students = User::where('role', 'siswa')
                        ->whereIn('kelas', $kelasGuru)
                        ->get();

        return view('guru.select_student', compact('students'));
    } elseif ($user->role === 'siswa') {
        // Siswa: lihat guru yang mengampunya (bisa dimodifikasi sesuai relasi)
        $gurus = User::where('role', 'guru')->get(); // Atau filter hanya guru yang mengampu kelasnya

        return view('siswa.select_guru', compact('gurus'));
    }

    abort(403);
}

public function show($id)
{
    $user = Auth::user();

    // Ambil user yang menjadi lawan chat (guru atau siswa)
    $receiver = User::findOrFail($id);

    // Ambil pesan antara user yang login dan receiver
    $messages = Message::where(function ($query) use ($user, $receiver) {
        $query->where('sender_id', $user->id)
              ->where('receiver_id', $receiver->id);
    })->orWhere(function ($query) use ($user, $receiver) {
        $query->where('sender_id', $receiver->id)
              ->where('receiver_id', $user->id);
    })->orderBy('created_at')->get();

    return view('discussion.show', compact('receiver', 'messages'));
}



public function store(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'content' => 'required|string|max:1000',
    ]);

    Message::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'content' => $request->content,
    ]);

    return back();
}

}
