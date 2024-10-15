<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
}
