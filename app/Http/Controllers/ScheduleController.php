<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Schedule::deleteById($id);

        return redirect()->to('/')->with('status', 'Jadwal telah dibatalkan');
    }

    public function request()
    {
        // $a = [
        //     "date" => "2022-02-10",
        //     "start" => "10:00",
        //     "end" => "11:00"
        // ];

        // dd(Schedule::check($a['date'], $a['start'], $a['end']));

        $current = session('currentMonth') ? Carbon::make(session('currentMonth')) : now();

        $data['title'] = 'Pengajuan Jadwal';
        $data['daysName'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $data['datesOfMonth'] = makePeriod($current);
        $data['offset'] = getOffset($data['daysName'], $current->firstOfMonth());
        $data['activeSchedules'] = Schedule::getActive();
        $data['current'] = $current;

        // Ambil seluruh data perhari di bulan ini
        $data['dataInMonth'] = Schedule::getInMonth($data['datesOfMonth']);

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

        // Redirect ke halaman request
        return redirect()->route('request')->with('currentMonth', $current->toDateString());
    }
}
