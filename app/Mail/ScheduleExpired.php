<?php

namespace App\Mail;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleExpired extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $expiredSchedule;

    public function __construct(Schedule $expiredSchedule)
    {
        $this->expiredSchedule = $expiredSchedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'expiredSchedule' => $this->expiredSchedule
        ];

        return $this
            ->to($this->expiredSchedule->borrower)
            ->subject('Pengajuan Jadwal Anda Telah Expired')
            ->view('email.schedule-expired', $data);
    }
}
