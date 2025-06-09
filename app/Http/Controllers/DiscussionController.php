<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiscussionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            $kelasGuru = $user->kelasDiampu->pluck('nama');
            $students = User::where('role', 'siswa')
                            ->whereIn('kelas', $kelasGuru)
                            ->get();
            return view('guru.select_student', compact('students'));
        } elseif ($user->role === 'siswa') {
            $kelas = $user->kelas;
            $kelasObj = Kelas::where('nama', $kelas)->first();
            $gurus = $kelasObj ? $kelasObj->guru : collect();
            return view('siswa.select_guru', compact('gurus'));
        }

        abort(403);
    }

    public function show($id)
    {
        $user = Auth::user();
        $receiver = User::findOrFail($id);
        
        

        // Validasi hak akses
        if (!$this->isAllowedToMessage($user, $receiver)) {
            abort(403, 'Kamu tidak diizinkan mengirim pesan ke user ini.');
        }

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
        $receiver = User::findOrFail($request->receiver_id);

        if (!$this->isAllowedToMessage(Auth::user(), $receiver)) {
            abort(403, 'Kamu tidak diizinkan mengirim pesan ke user ini.');
        }

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

    // ✅ Diletakkan di luar semua method lain
    private function isAllowedToMessage($sender, $receiver)
{
    if ($sender->role === 'guru') {
        return $sender->kelasDiampu->pluck('nama')->contains($receiver->kelas);
    } elseif ($sender->role === 'siswa') {
        $kelasObj = \App\Models\Kelas::where('nama', $sender->kelas)->first();
        return $kelasObj && $kelasObj->guru()->where('user_id', $receiver->id)->exists();
    }
    return false;
}

}
