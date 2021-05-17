<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $tags = Tag::with('posts')->where('name', 'LIKE', "%{$keyword}%")->paginate(10)->withQueryString();
        } else {
            $tags = Tag::with('posts')->paginate(10);
        }
        // $tags->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('tags.index', compact('tags'));
    }


    public function create()
    {
        return view('tags.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags,name'
        ]);

        $validatedData['slug'] = $validatedData['name'];

        Tag::create($validatedData);
        return redirect()->route('tags.index')->with('success', "{$validatedData['name']} created!");
    }


    public function show(Tag $Tag)
    {
        //
    }


    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags,name,' . $tag->id
        ]);
        $validatedData['slug'] = $validatedData['name'];
        $tag->update($validatedData);

        return redirect()->route('tags.index')->with('success', "{$validatedData['name']} updated!");
    }


    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
            return redirect()->back()->with('error', "Tag {$tag->name} digunakan oleh post");
        }

        $tag->delete();
        return redirect()->route('tags.index')->with('success', "{$tag->name} deleted!");
    }
}
