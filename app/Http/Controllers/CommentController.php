<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $forumId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'forum_id' => $forumId,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
    public function destroy($id)
{
    $comment = \App\Models\Comment::findOrFail($id);
    // Hanya pemilik komentar atau admin yang boleh hapus
    if (Auth::user()->id !== $comment->user_id && !Auth::user()->is_admin) {
        abort(403);
    }
    $comment->delete();
    return back()->with('success', 'Komentar berhasil dihapus.');
}
}
