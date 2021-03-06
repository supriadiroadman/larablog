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
            $posts = Post::with(['user', 'category', 'tags'])
                ->OrWhere('title', 'LIKE', "%{$search}%")->orWhere('content', 'LIKE', "%{$search}%")->paginate(6)->withQueryString();
        } else {
            $posts = Post::with(['user', 'category', 'tags'])->paginate(6);
        }

        $categories = Category::with('posts')->get();
        $tags = Tag::all();
        return view('welcome', compact('categories', 'tags', 'posts'));
    }
}
