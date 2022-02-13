<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Note;
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
        $data = getCalendarData();
        $data['title'] = 'Ubah Jadwal';
        $data['users'] = User::getBorrower();
        $data['schedule'] = Schedule::getById($id)[0];

        return view('schedule.edit', $data);
    }

    public function update(StoreScheduleRequest $request, $id)
    {
        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->date, $request->start, $request->end)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Insert data pengajuan
        Schedule::updateById($request->all(), $id);

        return redirect()->route('schedule.index')->with('status', 'Berhasil mengubah jadwal peminjaman.');
    }

    public function destroy($id)
    {
        Schedule::deleteById($id);
        Note::deleteByScheduleId($id);

        if (auth()->user()->role_id == 3) {
            return redirect()->to('/')->with('status', 'Jadwal telah dibatalkan');
        }

        return redirect()->route('schedule.index')->with('status', 'Jadwal telah dihapus');
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
