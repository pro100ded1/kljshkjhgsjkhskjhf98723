<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('mobile.profile');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:driver,passenger'
        ]);
        
        auth()->user()->update(['role' => $validated['role']]);
        return redirect()->back();
    }
}