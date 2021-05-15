<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Password di hash menggunakan mutator dimodel User (setPasswordAttribute)
        $validatedData = $request->password ? $request->all() : $request->except('password', 'password_confirmation');

        $profile->update($validatedData);

        return redirect()->back()->with('success', "Profiles {$validatedData['name']} updated!");
    }
}
