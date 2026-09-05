<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Blokir setelah 5x salah login dari IP yang sama dalam 1 menit
        $key = 'login:'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $detik = RateLimiter::availableIn($key);
            return back()->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$detik} detik.");
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            $route = Auth::user()->isAnggota() ? 'anggota.dashboard' : 'admin.dashboard';
            return redirect()->route($route)->with('success', 'Login berhasil!');
        }

        RateLimiter::hit($key, 60); // catat percobaan gagal, reset setelah 60 detik
        return back()->with('error', 'Username atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
