<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Division;
use App\Mail\ActivateUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    // halaman login
    public function login()
    {
        $data['admin'] = User::where('role_id', 1)->get()[0];

        return view('auth.login', $data);
    }

    public function register()
    {
        $data['divisions'] = Division::all();
        return view('auth.register', $data);
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

        if (!auth()->user()->status) {
            $userId = auth()->user()->id;
            auth()->logout();
            return back()->with('inactive', $userId);
        }

        // redirect ke halaman dashboard
        return redirect()->to('/')->with('status', 'Selamat datang, ' . auth()->user()->name);
    }

    // Proses pendaftaran akun peminjam
    public function registerProcess(RegisterRequest $request)
    {
        User::register($request->all());

        return redirect()->route('login')->with('success', 'Berhasil melakukan pendaftaran akun sebagai peminjam. Mohon tunggu tindak lanjut dari Administrator untuk melakukan aktivasi akun');
    }

    // proses logout
    public function logout()
    {
        // hapus session user
        auth()->logout();

        // kembali ke halaman login
        return redirect()->route('login');
    }

    public function activateRequest($id)
    {
        // Kirim email ke admin untuk aktivasi akun
        Mail::send(new ActivateUser($id));

        // Redirect back kehalaman login
        return back()->with('success', 'Berhasil mengajukan permohonan, silahkan tunggu tindak lanjut dari administrator.');
    }
}
