<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $data['title'] = 'Jadwal';
        $data['schedules'] = Schedule::orderByDesc('id')->get();

        return view('schedule.index', $data);
    }

    public function create()
    {
        $data = getCalendarData();
        $data['title'] = 'Tambah Jadwal';
        $data['users'] = User::getBorrower();

        return view('schedule.create', $data);
    }

    public function store(StoreScheduleRequest $request)
    {
        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->date, $request->start, $request->end)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Insert data pengajuan
        Schedule::insert($request->all());

        return redirect()->route('schedule.index')->with('status', 'Berhasil menambah jadwal peminjaman.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        dd($id);
    }

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
    }

    public function destroy($id)
    {
        $route = auth()->user()->role_id == 3 ? '/' : '/schedule';
        dd($route);
        Schedule::deleteById($id);

        return redirect()->to('/')->with('status', 'Jadwal telah dibatalkan');
    }

    public function request()
    {
        $data = getCalendarData();
        $data['title'] = 'Pengajuan Jadwal';

        return view('schedule.request', $data);
    }

    public function requestProcess(StoreScheduleRequest $request)
    {
        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->date, $request->start, $request->end)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Insert data pengajuan
        Schedule::insertRequest($request->all());

        return back()->with('status', 'Berhasil mengajukan jadwal peminjaman.');
    }

    public function scheduleProses($id)
    {
        return redirect()->to('/')->with('status', 'Jadwal ' . Schedule::setActive($id) . ' telah disetujui');
    }

    public function scheduleDecline($id)
    {
        return redirect()->to('/')->with('status', 'Pengajuan jadwal ' . Schedule::setDecline($id) . ' telah ditolak');
    }

    public function changeMonth($current, $counter)
    {
        // Ambil bulan selanjutnya berdasarkan counter
        $current = Carbon::make($current)->addMonth($counter);

        $route = auth()->user()->role_id == 3 ? 'request' : 'schedule.create';

        // Redirect ke halaman request
        return redirect()->route($route)->with('currentMonth', $current->toDateString());
    }
}
