<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Comment $comment)
    {
        $request->validate([
            'body_reply' => 'required|min:5'
        ]);

        $comment->replies()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body_reply
        ]);

        return redirect()->back()->with('success', "Berhasil Membalas Komentar " .
            substr($comment->user->name, 0, 20) . " ...");
    }
}
