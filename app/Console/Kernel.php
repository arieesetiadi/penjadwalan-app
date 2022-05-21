<?php

namespace App\Console;

use App\Console\Commands\SendScheduleNotificationCommand;
use App\Console\Commands\SetScheduleExpired;
use App\Console\Commands\SetScheduleFinish;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        SendScheduleNotificationCommand::class,
        SetScheduleFinish::class,
        SetScheduleExpired::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:send')->everyMinute();
        $schedule->command('schedule:finish')->everyMinute();
        $schedule->command('schedule:expired')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
