<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Boleh mengakses sistem hanya ketika sudah login
        $this->middleware('auth');
    }

    public function index()
    {
        // Redirect back jika user tidak aktif
        if (!auth()->user()->status) {
            auth()->logout();
            return redirect()->route('login')->with('inactive', auth()->user()->id);
        }

        // Prepare data untuk dashboard
        $data['title'] = 'Dashboard';
        $data['pendingSchedules'] = Schedule::getPending();
        $data['activeSchedules'] = Schedule::getActive();
        $data['countActive'] = count($data['activeSchedules']);
        $data['countPending'] = count($data['pendingSchedules']);

        // Cek user role
        switch (auth()->user()->role_id) {
            case 1:
                // Dashboard Admin
                $data = array_merge($data, getDashboardCalendarData());
                $data['countUser'] = User::count();

                return view('dashboard.administrator', $data);

            case 2:
                // Dashboard Petugas
                $data = array_merge($data, getDashboardCalendarData());
                $data['countActive'] = count($data['activeSchedules']);
                $data['countPending'] = count($data['pendingSchedules']);

                return view('dashboard.petugas', $data);

            default:
                // Dashboard Peminjam
                $data['activeSchedules'] = Schedule::getActiveByBorrowerId(auth()->user()->id);
                $data['pendingSchedules'] = Schedule::getPendingByBorrowerId(auth()->user()->id);
                $data['finishSchedules'] = Schedule::getFinishByBorrowerId(auth()->user()->id);
                $data['countActive'] = count($data['activeSchedules']);
                $data['countPending'] = count($data['pendingSchedules']);

                return view('dashboard.peminjam', $data);
        }
    }
}
