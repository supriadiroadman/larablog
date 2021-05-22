<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('settings.index', [
            'setting' => Setting::first()
        ]);
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validatedData =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'menu' => 'required',
        ]);
        $setting->update($validatedData);

        return redirect()->route('settings.index')->with('success', "Sukses update setting!");
    }
}
