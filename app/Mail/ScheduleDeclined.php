<?php

namespace App\Mail;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleDeclined extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new declineMessage instance.
     *
     * @return void
     */
    public $schedule;
    public $officer;
    public $declineMessage;

    public function __construct($scheduleId, $officerId, $declineMessage)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->officer = User::getById($officerId);
        $this->declineMessage = $declineMessage;
    }

    /**
     * Build the declineMessage.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'schedule' => $this->schedule,
            'officer' => $this->officer,
            'declineMessage' => $this->declineMessage
        ];

        $borrower = $this->schedule->borrower;

        return $this
            ->to($borrower)
            ->subject('Pengajuan Jadwal Ditolak')
            ->view('email.schedule-declined', $data);
    }
}
