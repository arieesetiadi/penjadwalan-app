<?php

namespace App\Http\Controllers;

use App\Mail\RoomDisabled;
use App\Mail\RoomEnabled;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RoomController extends Controller
{
    public function index()
    {
        $data['title'] = 'Kelola Ruangan';
        $data['rooms'] = Room::all();

        // Redirect ke halaman kelola ruangan
        return view('room.index', $data);
    }

    public function store(Request $request)
    {
        Room::insert($request->name);

        return redirect()->route('room.index')->with('status', 'Berhasil menambah ruangan baru.');
    }

    public function update(Request $request)
    {
        Room::updateById($request->name, $request->id);

        return redirect()->route('room.index')->with('status', 'Berhasil mengubah nama ruangan.');
    }

    public function destroy($id)
    {
        Room::find($id)->delete();

        return redirect()->route('room.index')->with('status', 'Berhasil menghapus data ruangan.');
    }

    public function enable($id)
    {
        $room = Room::find($id);
        $roomName = $room->name;

        $room->update([
            'status' => true
        ]);

        Mail::send(new RoomEnabled($room));

        return redirect()->route('room.index')->with('status', 'Berhasil mengaktifkan ruangan ' . $roomName . '.');
    }

    public function disable($id, Request $request)
    {
        $room = Room::find($id);
        $roomName = $room->name;

        $room->update([
            'status' => false
        ]);


        Mail::send(new RoomDisabled($room, $request->msg));

        return redirect()->route('room.index')->with('status', 'Berhasil menonaktifkan ruangan ' . $roomName . '.');
    }
}
