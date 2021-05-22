<?php

namespace App\Http\Controllers\Blog;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        if ($search) {
            $posts = Post::where('title', 'LIKE', "%{$search}%")->orWhere('content', 'LIKE', "%{$search}%")->paginate(8)->withQueryString();
        } else {
            $posts = Post::paginate(8);
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('welcome', compact('categories', 'tags', 'posts'));
    }
}
