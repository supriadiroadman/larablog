<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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

Route::get('/tes', function () {
    $img = Image::make('foo.jpg')->resize(200, 200)->save('bar.jpg');

    return $img->response('jpg');
});

Route::get('/', function () {
    return view('layouts.master');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        // 'posts' => PostController::class,
    ]);
    // Bila ingin menggunakan slug tanpa merubah id menjadi slug di model 
    Route::resource('posts', PostController::class)->except(['edit', 'show']);
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
});

// Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
