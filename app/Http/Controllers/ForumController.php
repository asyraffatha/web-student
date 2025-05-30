<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // Menampilkan daftar forum
    public function index()
    {
        $kelas = Auth::user()->kelas;

        $forums = Forum::with('user')
        ->where('kelas', $kelas)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('forums.forum', compact('forums'));
    }

    // Menampilkan form untuk membuat forum baru
    public function create()
    {
        return view('forums.create');
    }

    // Menyimpan forum baru ke database
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'content' => 'required|string',
    ]);

    Forum::create([
        'title' => $request->title,
        'description' => $request->description, // <-- ini penting!
        'content' => $request->content,
        'user_id' => Auth::id(),
        'kelas' => Auth::user()->kelas, 
    ]);

    return redirect()->route('forums.index')->with('success', 'Forum berhasil dibuat.');
}
 

    // Menampilkan detail forum
    public function show($id)
    {
        $forum = Forum::with(['user', 'comments.user'])->findOrFail($id);
        return view('forums.show', compact('forum'));
    }

    // Menampilkan form untuk mengedit forum (opsional)
    public function edit($id)
    {
        $forum = Forum::findOrFail($id);
        return view('forums.edit', compact('forum'));
    }

    // Memperbarui forum yang ada (opsional)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $forum = Forum::findOrFail($id);
        $forum->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forums.index')->with('success', 'Forum berhasil diperbarui.');
    }

    // Menghapus forum (opsional)
    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return redirect()->route('forums.index')->with('success', 'Forum berhasil dihapus.');
    }
}
