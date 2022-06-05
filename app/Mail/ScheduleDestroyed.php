<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleDestroyed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $schedule;
    protected $cancelMessage;

    public function __construct($scheduleId, $cancelMessage)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->cancelMessage = $cancelMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->schedule->borrower)
            ->subject('Jadwal Anda Telah Dibatalkan Oleh Petugas')
            ->view('email.schedule-destroyed', [
                'schedule' => $this->schedule,
                'cancelMessage' => $this->cancelMessage
            ]);
    }
}
