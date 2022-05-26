<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Division;
use App\Models\Schedule;
use App\Mail\UserEnabled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\UserDisabled;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = 'Kelola Pengguna';
        $data['users'] = User::get();

        // Redirect ke halaman kelola users
        return view('user.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengguna';
        $data['roles'] = Role::all();
        $data['divisions'] = Division::all();

        // Redirect ke halaman kelola users
        return view('user.create', $data);
    }

    public function store(StoreUserRequest $request)
    {
        // Insert data user
        User::insert($request->all());

        return redirect()->route('user.index')->with('status', 'Berhasil menambah pengguna baru.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['title'] = 'Ubah Pengguna';
        $data['roles'] = Role::all();
        $data['divisions'] = Division::all();
        $data['user'] = User::getById($id);

        // Redirect ke halaman kelola users
        return view('user.edit', $data);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        // Insert data user
        User::updateById($request->all(), $id);

        return redirect()->route('user.index')->with('status', 'Berhasil mengubah data pengguna.');
    }

    public function destroy($id)
    {
        dd($id);
    }

    public function enable($id)
    {
        // Ambil nama user berdasarkan ID
        $name = User::getById($id)->name;

        // Aktifkan status user
        User::enable($id);

        // Kirim email ke pengguna yang bersangkutan
        Mail::send(new UserEnabled($id));

        return redirect()->route('user.index')->with('status',  $name . ' telah diaktifkan.');
    }

    public function disable($id, Request $request)
    {
        // Ambil user berdasarkan ID
        $name = User::getById($id)->name;

        // Hapus jadwal yang ada berdasarkan user id
        Schedule::deleteRunningByUserId($id);

        // Nonaktifkan status user
        User::disable($id);

        // Kirim email ke pengguna yang bersangkutan
        Mail::send(new UserDisabled($id, $request->msg));

        return redirect()->route('user.index')->with('status', $name . ' telah dinonaktifkan dari sistem.');
    }

    public function search(Request $request)
    {
        // Redirect ke halaman utama jika tidak ada key
        if (!$request->key) {
            return redirect()->route('user.index');
        }

        $data['title'] = 'Kelola Pengguna';
        $data['users'] = User::search($request->key);

        // Redirect ke halaman kelola users
        return view('user.index', $data);
    }

    public function profile()
    {
        $data['roles'] = Role::all();
        $data['divisions'] = Division::all();
        $data['user'] = User::getById(auth()->user()->id);
        $data['title'] = 'Profile';

        return view('user.profile', $data);
    }

    public function profileEdit(UpdateProfileRequest $request)
    {
        // Update data user
        User::updateById($request->all(), auth()->user()->id);

        return back()->with('status', 'Berhasil mengubah profile pengguna.');
    }
}
