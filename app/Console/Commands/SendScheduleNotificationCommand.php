<?php

namespace App\Console\Commands;

use App\Mail\ScheduleStarted;
use App\Models\Schedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendScheduleNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification on meeting start';

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
        // 1. Cari jadwal yang akan segera dimulai - Model
        $schedules = Schedule::getAlmostStarted(10);

        if (count($schedules) > 0) {
            foreach ($schedules as $schedule) {
                // 2. Kirim email ke masing" peminjam
                Mail::send(new ScheduleStarted($schedule->id));
            }
        }
    }
}
