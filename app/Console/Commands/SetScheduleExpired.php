<?php

namespace App\Console\Commands;

use App\Mail\ScheduleExpired;
use App\Models\Schedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SetScheduleExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete schedule on expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ambil data jadwal yang expired
        $expiredSchedules = Schedule::getExpired();

        // Delete jadwal by ID
        foreach ($expiredSchedules as $expired) {
            Schedule::deleteById($expired->id);

            // Kirim notifikasi ke peminjam bahwa jadwal telah expired dan dihapus
            Mail::send(new ScheduleExpired($expired));
        }

        Log::info('Schedule executed: schedule:expired');
    }
}
