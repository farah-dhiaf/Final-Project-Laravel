<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $user = Auth::user();
            $month = now()->month;
            $year = now()->year;
            return redirect()->intended("/home/{$user->username}");
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->intended('/');
    }

    public function updateProfile(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        DB::table('users')
        ->where('id', Auth::id())
        ->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'updated_at' => now() // Pastikan timestamp ter-update
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->intended("/profile/{$request->username}")->with('success', 'Profile updated successfully!');
    }

    public function deleteProfile()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Hapus user dari database
        DB::table('users')
        ->where('id', Auth::id())
        ->delete();

        // Logout setelah menghapus user
        Auth::logout();

        // Redirect ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Profile deleted successfully.');
    }
}
