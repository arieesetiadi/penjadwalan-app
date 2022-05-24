<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //  =================================================================
    public static function get()
    {
        return self::orderByDesc('id')->get();
    }

    public static function getBorrower()
    {
        return self
            ::where('role_id', 3)
            ->get();
    }

    public static function getOfficers()
    {
        return self
            ::where('role_id', '<=', 2)
            ->get();
    }

    public static function getAdmins()
    {
        return self
            ::where('role_id', 1)
            ->get();
    }

    public static function insert($data)
    {
        self
            ::create([
                'username' => $data['username'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'status' => 1,
                'role_id' => $data['role'],
                'division_id' => $data['division'],
                'gender' => $data['gender']
            ]);
    }

    public static function updateById($data, $id)
    {
        $user = self::where('id', $id);

        $user->update([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => $data['role'],
            'division_id' => $data['division'],
            'gender' => $data['gender']
        ]);

        if ($data['password']) {
            $user->update(['password' => Hash::make($data['password'])]);
        }
    }

    public static function search($key)
    {
        return self
            ::where('name', 'like', '%' . $key . '%')
            ->orderByDesc('id')
            ->get();
    }

    public static function getById($id)
    {
        return self
            ::find($id);
    }

    public static function enable($id)
    {
        self
            ::find($id)
            ->update([
                'status' => 1
            ]);
    }

    public static function disable($id)
    {
        self
            ::find($id)
            ->update([
                'status' => 0
            ]);
    }

    //  =================================================================

    // Relasi dengan model Role
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    // Relasi dengan model Division
    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }
}
