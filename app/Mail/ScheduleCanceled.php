<?php

namespace App\Mail;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleCanceled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $schedule;
    protected $officers;
    protected $cancelMessage;

    public function __construct($scheduleId, $cancelMessage)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->officers = User::getOfficers();
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
            ->bcc($this->officers)
            ->subject('Pengajuan Jadwal Dibatalkan')
            ->view('email.schedule-canceled' , [
                'schedule' => $this->schedule,
                'cancelMessage' => $this->cancelMessage
            ]);
    }
}
