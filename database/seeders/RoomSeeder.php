<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            [1, 'Damamaya Command Room'],
        ];

        foreach ($rooms as $room) {
            Room::create([
                'name' => $room[1]
            ]);
        }
    }
}
