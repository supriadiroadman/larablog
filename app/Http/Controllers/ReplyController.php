<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $replies = Reply::with('comment', 'user')
                ->orWhere('body', 'LIKE', "%{$keyword}%")
                ->orWhereHas('comment', function (Builder $query) use ($keyword) {
                    $query->where('body', 'LIKE', "%{$keyword}%");
                })
                ->orWhereHas('user', function (Builder $query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                ->paginate(10)->withQueryString();
        } else {
            $replies = Reply::with('comment', 'user')->paginate(10);
        }
        // $replies->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('replies.index', compact('replies'));
    }


    public function destroy(Reply $reply)
    {
        $reply->delete();

        return redirect()->route('replies.index')->with('success', "Berhasil Menghapus Reply comment " .
            substr($reply->body, 0, 20) . " ...");
    }
}
