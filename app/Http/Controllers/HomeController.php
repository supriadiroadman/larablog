<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoriesCount = Category::all()->count();
        $tagsCount = Tag::all()->count();
        $postsCount = Post::all()->count();
        $usersCount = User::all()->count();
        return view('home', compact('categoriesCount', 'tagsCount', 'postsCount', 'usersCount'));
    }
}
