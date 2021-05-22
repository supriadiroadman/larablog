<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $comments = Comment::with('post', 'user')
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhereHas('post', function (Builder $query) use ($keyword) {
                    $query->where('title', 'LIKE', "%{$keyword}%");
                })
                ->orWhereHas('user', function (Builder $query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                ->paginate(10)->withQueryString();
        } else {
            $comments = Comment::with('post', 'user')->paginate(10);
        }
        // $comments->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('comments.index', compact('comments'));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', "Berhasil Menghapus Comment " .
            substr($comment->body, 0, 20) . " ...");
    }
}
