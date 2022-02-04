<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Division;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Kelola Pengguna';
        $data['users'] = User::get();

        // Redirect ke halaman kelola users
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Pengguna';
        $data['roles'] = Role::all();
        $data['divisions'] = Division::all();

        // Redirect ke halaman kelola users
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // Insert data user
        User::insert($request->all());

        return redirect()->route('user.index')->with('status', 'Berhasil menambah pengguna baru.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Ubah Pengguna';
        $data['roles'] = Role::all();
        $data['divisions'] = Division::all();
        $data['user'] = User::getById($id);

        // Redirect ke halaman kelola users
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // Insert data user
        User::updateById($request->all(), $id);

        return redirect()->route('user.index')->with('status', 'Berhasil mengubah data pengguna.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function search(Request $request)
    {
        $data['title'] = 'Kelola Pengguna';
        $data['users'] = User::search($request->key);

        // Redirect ke halaman kelola users
        return view('user.index', $data);
    }
}
