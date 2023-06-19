<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Sign In',
        ];
        return view('auth.login', $data);
    }

    public function submitLogin(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|email:dns',
                'password' => 'required|min:8|max:32',
            ],
            [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'password.max' => 'Password maksimal 32 karakter',
            ]
        );
        if (Auth::attempt($validatedData)) {
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Email atau password salah');
        }
        return redirect('/login')->withErrors($validatedData);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
