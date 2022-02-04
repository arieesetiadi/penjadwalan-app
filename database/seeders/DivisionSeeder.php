<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            'Bagian Umum dan Kepegawaian', 'Bagian Perencanaan dan Pelaporan', 'Bagian Keuangan', 'Bidang Pengelolaan Informasi Publik', 'Bidang Pengelolaan Komunikasi Publik', 'Bidang Teknologi, Informasi, dan Komunikasi', 'Bidang Persandian'
        ];

        foreach ($divisions as $division) {
            Division::create([
                'name' => $division
            ]);
        }
    }
}
