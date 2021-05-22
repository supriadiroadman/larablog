<?php

use App\Http\Controllers\Blog\BlogPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Blog\CommentReplyController;
use App\Http\Controllers\Blog\PostCommentController;
use App\Http\Controllers\Blog\WelcomeController;
use App\Http\Controllers\CommentController;
use Intervention\Image\ImageManagerStatic as Image;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Frontend
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/posts/{post:slug}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('/category/{category:slug}', [BlogPostController::class, 'category'])->name('blog.category');
Route::get('/tag/{tag:slug}', [BlogPostController::class, 'tag'])->name('blog.tag');
Route::get('/author/{user:slug}', [BlogPostController::class, 'author'])->name('blog.author');
Route::resource('posts.comments', PostCommentController::class)->only('store');
Route::resource('comments.replies', CommentReplyController::class)->only('store');


// Auth
Auth::routes();

// Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        // 'posts' => PostController::class,
    ]);
    // Bila ingin menggunakan slug tanpa merubah id menjadi slug di model 
    Route::resource('posts', PostController::class)->except(['edit']);
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::resource('users', UserController::class)->only('index', 'create', 'store', 'destroy');
    Route::post('users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
    Route::post('users/{user}/make-user', [UserController::class, 'makeUser'])->name('users.make-user');
    Route::resource('profiles', ProfileController::class)->only('index', 'update');
    Route::resource('comments', CommentController::class)->only('index', 'destroy');
});

// Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
