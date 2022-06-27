<?php

namespace App\Mail;

use App\Models\Room;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $schedule, $borrower, $officer, $room;

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
            ->subject('Jadwal Anda Telah Berhasil Diubah')
            ->view('email.schedule-updated', [
                'schedule' => $this->schedule,
                'officer' => $this->officer,
                'room' => $this->room
            ]);
    }
}
