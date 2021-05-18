<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $posts = Post::with('category', 'tags', 'user')
                ->orWhere('title', 'LIKE', "%{$keyword}%")->orWhere('content', 'LIKE', "%{$keyword}%")
                ->orWhereHas('category', function (Builder $query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                ->orWhereHas('user', function (Builder $query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                ->orWhereHas('tags', function (Builder $query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                })
                ->paginate(10)->withQueryString();
        } else {
            $posts = Post::with('category', 'tags', 'user')->paginate(10);
        }
        // $posts->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255|unique:posts,title',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $slug = Str::slug(substr($request->title, 0, 15));
            $ext = $file->getClientOriginalExtension();
            $filename = $slug . '-' . time() . '.' . $ext;

            // Store image
            $file->storeAs('public/posts', $filename);

            // Resize image
            $path = public_path('storage/posts/' . $filename);
            $img = Image::make($path)->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);

            // Save name image to database
            $validatedData['image'] = $filename;
        }

        $validatedData['slug'] = $request->title;
        $validatedData['user_id'] = auth()->user()->id;

        $post = Post::create($validatedData);
        $post->tags()->attach($request->tag_id);

        return redirect()->route('posts.index')->with('success', "Berhasil Menambah Post " .
            substr($request->title, 0, 20) . " ...");
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        // $this->authorize('updateOrDelete-post', $post);
        if (Gate::denies('updateOrDelete-post', $post)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }


    public function update(Request $request, Post $post)
    {
        // $this->authorize('updateOrDelete-post', $post);
        if (Gate::denies('updateOrDelete-post', $post)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $post->id,
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg'
        ]);

        if ($request->hasFile('image')) {
            $image_path = "storage/posts/" . $post->image;
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            $file = $request->file('image');

            $slug = Str::slug(substr($request->title, 0, 15));
            $ext = $file->getClientOriginalExtension();
            $filename = $slug . '-' . time() . '.' . $ext;

            // Store image
            $file->storeAs('public/posts', $filename);

            // Resize image
            $path = public_path('storage/posts/' . $filename);
            $img = Image::make($path)->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path);

            // Save name image to database
            $validatedData['image'] = $filename;
        }

        $validatedData['slug'] = $request->title;
        $validatedData['user_id'] = auth()->user()->id;

        $post->tags()->sync($request->tag_id);
        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', "Berhasil Mengupdate Post " .
            substr($request->title, 0, 20) . " ...");
    }


    public function destroy(Post $post)
    {
        // $this->authorize('updateOrDelete-post', $post);
        if (Gate::denies('updateOrDelete-post', $post)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }

        $image_path = "storage/posts/" . $post->image;
        if (file_exists($image_path)) {
            @unlink($image_path);
        }

        $post->tags()->detach();
        $post->delete();
        return redirect()->route('posts.index')->with('success', "Berhasil Menghapus Post " .
            substr(request()->title, 0, 20) . " ...");
    }
}
