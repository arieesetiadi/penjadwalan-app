<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['admin', 'Putu Arie Suastra', 'ariesetiadi.sm@gmail.com', 'admin', '082146335727', 'Pria', 1, 4],
            ['petugas', 'Made Suastra', 'ariesetiadi.wr@gmail.com', 'petugas', '089671800585', 'Wanita', 2, 5],
            ['peminjam', 'Nyoman Setiadi', 'ariesetiadi.bn@gmail.com', 'peminjam', '089671800585', 'Pria', 3, 6],
        ];

        User::truncate();

        foreach ($users as $user) {
            User::create([
                'username' => $user[0],
                'name' => $user[1],
                'email' => $user[2],
                'password' => Hash::make($user[3]),
                'phone' => $user[4],
                'gender' => $user[5],
                'role_id' => $user[6],
                'division_id' => $user[7],
                'created_at' => now()->toDateTimeString(),
            ]);
        }
    }
}
