<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Update last login
            Auth::user()->update(['last_login' => now()]);

            return redirect()->intended(route('home'))->with('success', 'Welcome back, ' . Auth::user()->username . '!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }

    public function showCreate()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }
}