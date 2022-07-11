<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomEnabled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $room;
    private $borrower;

    public function __construct($room)
    {
        $this->room = $room;
        $this->borrower = User::getBorrower();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['room'] = $this->room;

        $roomName = $this->room->name;

        return $this
            ->bcc($this->borrower)
            ->subject("Ruangan $roomName Telah Diaktifkan")
            ->view('email.room-enabled', $data);
    }
}
