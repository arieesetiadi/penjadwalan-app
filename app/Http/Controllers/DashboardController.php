<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
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
                $data['countUser'] = User::count();
                $data['countPending'] = count(Schedule::getPending());
                $data['countActive'] = count(Schedule::getActive());
                $data['pendingSchedules'] = Schedule::getPending();
                $data['activeSchedules'] = Schedule::getActive();

                // Redirect ke dashboard Administrator
                return view('dashboard.administrator', $data);

            case 2:
                // Redirect ke dashboard Petugas
                return view('dashboard.petugas', $data);

            default:
                $data['activeSchedules'] = Schedule::getActiveByBorrowerId(auth()->user()->id);
                $data['pendingSchedules'] = Schedule::getPendingByBorrowerId(auth()->user()->id);
                $data['finishSchedules'] = Schedule::getFinishByBorrowerId(auth()->user()->id);
                $data['countPending'] = count($data['pendingSchedules']);
                $data['countActive'] = count($data['activeSchedules']);

                // Redirect ke dashboard Peminjam
                return view('dashboard.peminjam', $data);
        }
    }
}
