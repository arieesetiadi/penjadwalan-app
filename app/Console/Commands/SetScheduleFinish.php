<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Illuminate\Console\Command;

class SetScheduleFinish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set schedule status to finish';

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
        // 1. Cari jadwal yang selesai saat ini
        $schedule = Schedule::getAlmostFinish()[0];

        // 2. Set jadwal ke finish
        Schedule::setFinish($schedule->id);
    }
}
