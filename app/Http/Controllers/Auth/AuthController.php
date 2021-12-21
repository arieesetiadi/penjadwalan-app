<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses validasi data login
    public function loginProcess(Request $request)
    {
        // validasi input dari form
        $user = $request->validate([
            'username' => 'required|max:20',
            'password' => 'required'
        ]);

        $rememberMe = $request->rememberMe == 'on' ? true : false;

        // lakukan proses login
        if (!auth()->attempt($user, $rememberMe)) {
            return back()->with('status', 'Username/password yang dimasukan belum valid.');
        }

        // redirect ke halaman dashboard
        return redirect()->to('/')->with('greeting', 'Selamat datang, ' . auth()->user()->name);
    }

    // proses logout
    public function logout()
    {
        // hapus session user
        auth()->logout();

        // kembali ke halaman login
        return redirect()->route('login');
    }
}
