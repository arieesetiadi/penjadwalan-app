<?php

namespace App\Mail;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $schedule;
    public $officer;

    public function __construct($scheduleId, $officerId)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->officer = User::getById($officerId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'schedule' => $this->schedule,
            'officer' => $this->officer
        ];

        $borrower = $this->schedule->borrower;

        return $this
            ->from($this->officer)
            ->to($borrower)
            ->subject('Jadwal Telah Disetujui')
            ->view('email.schedule-approved', $data);
    }
}
