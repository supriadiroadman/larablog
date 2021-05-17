<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Jika role bukan admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('profiles.index')->with('error', "Anda tidak memiliki akses");
        }

        $keyword = $request->keyword;

        if ($keyword) {
            $users = User::with('posts')->where('name', 'LIKE', "%{$keyword}%")->paginate(10)->withQueryString();
        } else {
            $users = User::with('posts')->paginate(10);
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

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', "{$validatedData['name']} created!");
    }

    public function destroy(User $user)
    {
        if ($user->posts->count() > 0) {
            return redirect()->back()->with('error', "Tidak bisa menghapus User {$user->name} karena memiliki post");
        }

        if (auth()->user()->isAdmin()) {
            if ($user->id == '1') {
                return redirect()->back()->with('error', "User {$user->name} tidak boleh dihapus");
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', "{$user->name} deleted!");
        }

        return redirect()->back()->with('error', "Anda tidak memiliki akses");
    }

    public function makeAdmin(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', "Anda tidak memiliki akses");
        }

        $user->role = 'admin';
        $user->save();

        return redirect()->back()->with('success', "{$user->name} make admin");
    }
    public function makeUser(User $user)
    {
        // Jika role bukan admin
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', "Anda tidak memiliki akses");
        }

        // Jika role yang login= admin dan user id =1 tidak boleh khusus utk id ini
        if (auth()->user()->isAdmin() && $user->id == '1') {
            return redirect()->back()->with('error', "Tidak di izinkan");
        }

        $user->role = 'user';
        $user->save();

        return redirect()->back()->with('success', "{$user->name} make user");
    }
}
