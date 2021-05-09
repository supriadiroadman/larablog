<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $categories = Category::where('name', 'LIKE', "%{$keyword}%")->paginate(2)->withQueryString();
        } else {
            $categories = Category::paginate(10);
        }
        // $categories->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        $validatedData['slug'] = $validatedData['name'];

        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', "{$validatedData['name']} created!");
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ]);
        $validatedData['slug'] = $validatedData['name'];
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', "{$validatedData['name']} updated!");
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', "{$category->name} deleted!");
    }
}
