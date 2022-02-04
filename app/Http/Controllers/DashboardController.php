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

        // redirect ke halaman dashboard
        return view('dashboard', $data);
    }
}
