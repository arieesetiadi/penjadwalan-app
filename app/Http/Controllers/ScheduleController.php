<?php

namespace App\Http\Controllers;

use App\Mail\ScheduleCanceled;
use App\Mail\ScheduleDestroyed;
use App\Mail\ScheduleStarted;
use Carbon\Carbon;
use App\Models\Note;
use App\Models\Room;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Mail\ScheduleApproved;
use App\Mail\ScheduleDeclined;
use App\Mail\ScheduleRequested;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\StoreScheduleRequest;
use App\Mail\RequestSuccess;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Kelola Jadwal';
        $data['schedules'] = Schedule::orderByDesc('id')->get();

        return view('schedule.index', $data);
    }

    public function create()
    {
        $data = getCalendarData();
        $data['title'] = 'Tambah Jadwal';
        $data['rooms'] = Room::all();
        $data['users'] = User::getBorrower();

        return view('schedule.create', $data);
    }

    public function store(StoreScheduleRequest $request)
    {
        // Return back jika jam sudah lewat
        if ($request->start < now()->format('H:i') || $request->end < now()->format('H:i')) {
            return back()->with('invalidTime', 'Invalid Time')->withInput($request->all());
        }

        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->room, $request->date, $request->start, $request->end)) {
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
        $data['rooms'] = Room::all();
        $data['schedule'] = Schedule::getById($id)[0];

        return view('schedule.edit', $data);
    }

    public function update(StoreScheduleRequest $request, $id)
    {
        // Return back jika jam sudah lewat
        if (isDateTimePass($request)) {
            return back()->with('invalidTime', 'Invalid Time')->withInput($request->all());
        }

        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->room, $request->date, $request->start, $request->end, $id)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Insert data pengajuan
        Schedule::updateById($request->all(), $id);

        return redirect()->route('schedule.index')->with('status', 'Berhasil mengubah jadwal peminjaman.');
    }

    public function destroy($id, Request $request)
    {
        Mail::send(new ScheduleDestroyed($id, $request->cancelMessage));
        Schedule::deleteById($id);
        Note::deleteByScheduleId($id);

        return redirect()->route('schedule.index')->with('status', 'Jadwal telah dibatalkan');
    }

    // Halaman pengajuan
    public function request()
    {
        $data = getCalendarData();
        $data['title'] = 'Pengajuan Jadwal';
        $data['rooms'] = Room::all();

        return view('schedule.request', $data);
    }

    // Proses pengajuan
    public function requestProcess(StoreScheduleRequest $request)
    {
        // Return back jika jam sudah lewat
        if (isDateTimePass($request)) {
            return back()->with('invalidTime', 'Invalid Time')->withInput($request->all());
        }

        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->room, $request->date, $request->start, $request->end)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Insert data pengajuan
        Schedule::insertRequest($request->all());

        // Kirim notifikasi ke petugas & administrator
        $officers = User::getOfficers();
        foreach ($officers as $officer) {
            Mail::send(new ScheduleRequested($request->all(), auth()->user()->id, $officer));
        }

        // Kirim notifikasi ke peminjam bahwa telah mengajukan jadwal
        Mail::send(new RequestSuccess($request->all(), auth()->user()->id));

        return redirect()->to('/')->with('status', 'Berhasil mengajukan jadwal peminjaman.');
    }

    // Persetujuan jadwal
    public function scheduleProses($id)
    {
        $schedule = Schedule::getById($id)[0];

        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($schedule->room_id, $schedule->date, $schedule->start, $schedule->end)) {
            return back()->with('warning', 'Jadwal telah digunakan.');
        }

        Mail::send(new ScheduleApproved($id, auth()->user()->id));

        return redirect()->to('/')->with('status', 'Jadwal ' . Schedule::setActive($id) . ' telah disetujui');
    }

    // Penolakan jadwal
    public function scheduleDecline(Request $request)
    {
        Mail::send(new ScheduleDeclined($request->id, auth()->user()->id, $request->declineMessage));

        return redirect()->to('/')->with('status', 'Pengajuan jadwal ' . Schedule::setDecline($request->id) . ' telah ditolak');
    }

    public function changeMonth($current, $counter)
    {
        // Ambil bulan selanjutnya berdasarkan counter
        $current = Carbon::make($current)->addMonth($counter);

        $route = auth()->user()->role_id == 3 ? 'request' : 'schedule.create';

        // Redirect ke halaman request
        return redirect()->route($route)->with('currentMonth', $current->toDateString());
    }

    public function requestEdit($id)
    {
        $data = getCalendarData();
        $data['title'] = 'Jadwal';
        $data['schedule'] = Schedule::getById($id)[0];
        $data['rooms'] = Room::all();

        return view('schedule.request-edit', $data);
    }

    public function requestUpdate($id, Request $request)
    {
        // Return back jika jam sudah lewat
        if (isDateTimePass($request)) {
            return back()->with('invalidTime', 'Invalid Time')->withInput($request->all());
        }

        // Redirect back, jika jadwal tidak dapat digunakan
        if (!Schedule::check($request->room, $request->date, $request->start, $request->end, $id)) {
            return back()->with('warning', 'Jadwal telah digunakan.')->withInput($request->all());
        }

        // Kirim notifikasi ke petugas & administrator
        $officers = User::getOfficers();

        foreach ($officers as $officer) {
            Mail::send(new ScheduleRequested($request->all(), auth()->user()->id, $officer));
        }

        // Kirim notifikasi ke peminjam bahwa telah mengajukan jadwal
        Mail::send(new RequestSuccess($request->all(), auth()->user()->id));

        // Insert data pengajuan
        Schedule::updateRequest($request->all(), $id);

        return redirect()->route('dashboard')->with('status', 'Berhasil mengajukan jadwal peminjaman.');
    }

    public function scheduleCancel($id, Request $request)
    {
        Mail::send(new ScheduleCanceled($id, $request));
        Schedule::deleteById($id);
        Note::deleteByScheduleId($id);

        return redirect()->to('/')->with('status', 'Jadwal telah dibatalkan');
    }

    public function scheduleFinish($id)
    {
        return redirect()->to('/')->with('status', 'Jadwal ' . Schedule::setFinish($id) . ' telah diselesaikan');
    }

    public function reset()
    {
        Schedule::truncate();
        Note::truncate();
        Artisan::call('db:seed --class=UserSeeder');

        return redirect('/');
    }

    public function search(Request $request)
    {
        // Redirect ke halaman utama jika tidak ada key
        if (!$request->key) {
            return redirect()->route('schedule.index');
        }

        $data['title'] = 'Kelola Jadwal';
        $data['schedules'] = Schedule::search($request->key);

        // Redirect ke halaman kelola users
        return view('schedule.index', $data);
    }

    // H - 10m
    public function demo()
    {
        $schedule = Schedule
            ::where('status', 2)
            ->first();

        Mail::send(new ScheduleStarted($schedule->id));

        $newStart = now()->addMinute(10)->addSecond(15)->format('H:i:s');
        $newEnd = now()->addMinute(15)->format('H:i');

        $schedule->update([
            'date' => now()->format('Y-m-d'),
            'start' => $newStart,
            'end' => $newEnd
        ]);

        return redirect('/');
    }

    // H
    public function demo2()
    {
        $nowDate = now()->format('Y-m-d');
        $newStart = now()->format('H:i');
        $newEnd = now()->addMinute(30)->format('H:i');

        Schedule
            ::where('status', 2)
            ->first()
            ->update([
                'date' => $nowDate,
                'start' => $newStart,
                'end' => $newEnd
            ]);

        return redirect('/');
    }

    // Jadwal selesai
    public function demo3()
    {
        $nowDate = now()->format('Y-m-d');
        $newStart = now()->subMinute(30)->format('H:i');
        $newEnd = now()->subMinute(5)->format('H:i');

        Schedule
            ::where('status', 2)
            ->first()
            ->update([
                'status' => 4,
                'date' => $nowDate,
                'start' => $newStart,
                'end' => $newEnd
            ]);

        return redirect('/');
    }

    //    Pengajuan expired
    public function demo4()
    {
        $nowDate = now()->format('Y-m-d');
        $newStart = now()->subHour(2)->format('H:i');
        $newEnd = now()->subHour(1)->format('H:i');

        Schedule
            ::where('status', 1)
            ->first()
            ->update([
                'date' => $nowDate,
                'start' => $newStart,
                'end' => $newEnd,
            ]);

        return redirect('/');
    }

    // Ready to roll
    public function prepare()
    {
        $schedules = [
            [
                'date' => now()->addDay(1)->format('Y-m-d'),
                'start' => '09:00',
                'end' => '11:00',
                'description' => 'Rapat A',
                'user_borrower_id' => 3,
                'room_id' => 1,
                'status' => 1,
                'created_at' => now()->format('Y-m-d H:i:s.u0')
            ],
            [
                'date' => now()->addDay(1)->format('Y-m-d'),
                'start' => '14:00',
                'end' => '15:00',
                'description' => 'Rapat B',
                'user_borrower_id' => 3,
                'room_id' => 1,
                'status' => 1,
                'created_at' => now()->format('Y-m-d H:i:s.u0')
            ],
            [
                'date' => now()->addDay(2)->format('Y-m-d'),
                'start' => '09:00',
                'end' => '13:00',
                'description' => 'Rapat C',
                'user_borrower_id' => 3,
                'room_id' => 1,
                'status' => 1,
                'created_at' => now()->format('Y-m-d H:i:s.u0')
            ],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }

        return redirect('/');
    }

    public static function addPending($n)
    {
        for ($i = 0; $i < $n; $i++) {
            Schedule::create([
                'date' => now()->addDay(1)->format('Y-m-d'),
                'start' => '09:00',
                'end' => '11:00',
                'description' => 'Rapat Review Aplikasi ABC',
                'user_borrower_id' => 3,
                'room_id' => 1,
                'status' => 1,
                'requested_at' => now()->format('Y-m-d H:i:s.u0')
            ]);
        }

        return redirect('/');
    }

    public static function addExpired($n)
    {
        for ($i = 0; $i < $n; $i++) {
            Schedule::create([
                'date' => now()->subDay(1)->format('Y-m-d'),
                'start' => '09:00',
                'end' => '11:00',
                'description' => 'Rapat Koordinasi',
                'user_borrower_id' => 3,
                'room_id' => 1,
                'status' => 1,
                'requested_at' => now()->subDay(2)->format('Y-m-d H:i:s.u0')
            ]);
        }

        return redirect('/');
    }
}
