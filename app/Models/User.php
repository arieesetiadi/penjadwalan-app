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

    public static function insert($user)
    {
        self
            ::create([
                'username' => $user['username'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'phone' => $user['phone'],
                'role_id' => $user['role'],
                'division_id' => $user['division'],
                'gender' => $user['gender']
            ]);
    }

    public static function search($key)
    {
        return self
            ::where('name', 'like', '%' . $key . '%')
            ->orderByDesc('id')
            ->get();
    }

    //  =================================================================

    // Relasi dengan model Role
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    // Relasi dengan model Instansi
    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }
}
