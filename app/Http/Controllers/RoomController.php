<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

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
}
