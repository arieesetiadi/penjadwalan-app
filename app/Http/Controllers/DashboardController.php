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
        $userId = auth()->user()->id;

        if (!auth()->user()->status) {
            auth()->logout();
            return redirect()->route('login')->with('inactive', $userId);
        }

        $data['title'] = 'Dashboard';

        // Cek role dari user yang sedang login
        switch (auth()->user()->role_id) {
                // Dashboard Admin
            case 1:
                $data = getDashboardCalendarData();

                $data['title'] = 'Dashboard';
                $data['pendingSchedules'] = Schedule::getPending();
                $data['activeSchedules'] = Schedule::getActive();

                $data['countUser'] = User::count();
                $data['countActive'] = count($data['activeSchedules']);
                $data['countPending'] = count($data['pendingSchedules']);

                // Redirect ke dashboard Administrator
                return view('dashboard.administrator', $data);

                // Dashboard Petugas
            case 2:
                $data = getDashboardCalendarData();

                $data['title'] = 'Dashboard';
                $data['pendingSchedules'] = Schedule::getPending();
                $data['activeSchedules'] = Schedule::getActive();

                $data['countActive'] = count($data['activeSchedules']);
                $data['countPending'] = count($data['pendingSchedules']);

                // Redirect ke dashboard Petugas
                return view('dashboard.petugas', $data);

                // Dashboard Peminjam
            default:
                $data['title'] = 'Dashboard';

                $data['activeSchedules'] = Schedule::getActiveByBorrowerId(auth()->user()->id);
                $data['pendingSchedules'] = Schedule::getPendingByBorrowerId(auth()->user()->id);
                $data['finishSchedules'] = Schedule::getFinishByBorrowerId(auth()->user()->id);

                $data['countActive'] = count($data['activeSchedules']);
                $data['countPending'] = count($data['pendingSchedules']);

                // Redirect ke dashboard Peminjam
                return view('dashboard.peminjam', $data);
        }
    }
}
