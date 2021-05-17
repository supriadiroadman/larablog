<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profiles.index')->with('user', Auth::user());
    }


    public function update(Request $request, User $profile)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $profile->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            $validatedData = $request->only('name', 'email');
        }

        $profile->update($validatedData);

        return redirect()->back()->with('success', "Profiles {$validatedData['name']} updated!");
    }
}
