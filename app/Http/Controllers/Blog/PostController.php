<?php

namespace App\Http\Controllers\Blog;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load(['comments.user', 'comments.replies.user', 'comments.replies']);
        return view('blog.show', compact('post'));
    }

    public function category(Category $category)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = $category->posts()->paginate(8);
        return view('welcome', compact('categories', 'tags', 'posts'));
    }

    public function tag(Tag $tag)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = $tag->posts()->paginate(8);
        return view('welcome', compact('categories', 'tags', 'posts'));
    }

    public function author(User $user)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = $user->posts()->paginate(8);
        return view('welcome', compact('categories', 'tags', 'posts'));
    }
}
