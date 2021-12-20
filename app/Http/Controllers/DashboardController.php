<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // boleh mengakses sistem hanya ketika sudah login
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // cek role dari user yang sedang login
        switch (auth()->user()->user_role_id) {
            case 1:
                return view('dashboard.admin', $data);
            case 2:
                return view('dashboard.admin', $data);
            default:
                return view('dashboard.admin', $data);
        }
    }
}
