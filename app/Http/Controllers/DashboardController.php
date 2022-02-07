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

        // Cek role dari user yang sedang login
        switch (auth()->user()->role_id) {
            case 1:
                // Redirect ke dashboard Administrator
                return view('dashboard.administrator', $data);
            case 2:
                // Redirect ke dashboard Petugas
                return view('dashboard.petugas', $data);
            default:
                // Redirect ke dashboard Peminjam
                return view('dashboard.peminjam', $data);
        }
    }
}
