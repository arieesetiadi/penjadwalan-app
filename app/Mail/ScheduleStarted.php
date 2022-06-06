<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleStarted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $schedule;
    public $borrower;
    public $officer;

    public function __construct($scheduleId)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->borrower = $this->schedule->borrower;
        $this->officer = $this->schedule->officer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'borrower' => $this->borrower,
            'schedule' => $this->schedule,
        ];

        return $this
            ->from($this->officer)
            ->to($this->borrower)
            ->subject('Jadwal Segera Dimulai')
            ->view('email.schedule-started', $data);
    }
}
