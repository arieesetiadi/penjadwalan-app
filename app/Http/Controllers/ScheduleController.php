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
        //
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
        // Ambil tanggal pertama dan terakhir bulan ini untuk membuat periode
        $firstDate = now()->firstOfMonth();
        $lastDate = now()->lastOfMonth();

        $data['title'] = 'Pengajuan Jadwal';
        $data['daysName'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $data['datesOfMonth'] = CarbonPeriod::create($firstDate->toDateString(), $lastDate->toDateString());
        $data['offset'] = getOffset($data['daysName'], $firstDate);
        $data['activeSchedules'] = Schedule::getActive();
        $data['current'] = now();

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
        Schedule::insert($request->all());

        return redirect()->to('/')->with('status', 'Berhasil mengajukan jadwal peminjaman.');
    }

    public function scheduleProses($id)
    {
        return redirect()->to('/')->with('status', 'Jadwal ' . Schedule::setActive($id) . ' telah disetujui');
    }
}
