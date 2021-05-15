<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $users = User::where('name', 'LIKE', "%{$keyword}%")->paginate(2)->withQueryString();
        } else {
            $users = User::paginate(10);
        }
        // $users->appends(['keyword' => $keyword]); // Cara ke 1 selain withQueryString()
        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', "{$validatedData['name']} created!");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', "{$user->name} deleted!");
    }
}
