<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Boleh mengakses sistem hanya ketika sudah login
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // Redirect ke halaman pengajuan jika role Peminjam
        if (auth()->user()->role_id == 3) return redirect()->route('pengajuan');

        // Redirect ke halaman dashboard
        return view('dashboard', $data);
    }
}
