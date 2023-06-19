<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LupaPassword extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Lupa Kata Sandi',
        ];
        return view('auth.lupa-password', $data);
    }
}
