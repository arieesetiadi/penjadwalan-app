<?php

namespace App\Mail;

use App\Models\Room;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $schedule;
    private $borrower;
    private $officer;
    private $room;

    public function __construct($schedule, $officerId)
    {
        $this->schedule = $schedule;
        $this->borrower = User::find($schedule['user']);
        $this->officer = User::find($officerId);
        $this->room = Room::find($schedule['room'])->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->borrower)
            ->subject('Jadwal Anda Telah Berhasil Dibuat')
            ->view('email.schedule-created', [
                'schedule' => $this->schedule,
                'officer' => $this->officer,
                'room' => $this->room
            ]);
    }
}
