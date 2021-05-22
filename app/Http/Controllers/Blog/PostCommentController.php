<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|min:5'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return redirect()->back()->with('success', "Berhasil Menambah Komentar " .
            substr($request->body, 0, 20) . " ...");
    }
}
