<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $dosens = Dosen::all();
        return view('auth.register', compact('dosens'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'nim' => 'required|unique:users,nim',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string|max:1000',
        ]);

        $profilePicPath = $request->file('profile_pic') ? $request->file('profile_pic')->store('profile_pics', 'public') : null;

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dosen_id' => $request->dosen_id,
            'profile_pic' => $profilePicPath,
            'bio' => $request->bio,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}
