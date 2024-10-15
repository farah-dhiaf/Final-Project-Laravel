<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
             'name' => 'required|max:255',
             'username' => 'required|min:3|max:255|unique:users',
             'email' => 'required|email|unique:users',
             'password' => 'required|min:8|max:50|confirmed'
        ]);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),  // Hash password
        ]);

        return redirect('/')->with('success', 'User registered successfully!');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password'],  // Hash password
        ]))
        {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('loginError', 'Login Failed');
    }
}
