<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RoomDisabled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $room;
    private $borrower;
    private $msg;

    public function __construct($room, $msg)
    {
        $this->room = $room;
        $this->msg = $msg;
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
        $data['msg'] = $this->msg;

        $roomName = $this->room->name;

        return $this
            ->bcc($this->borrower)
            ->subject("Ruangan $roomName Telah Dinonaktifkan")
            ->view('email.room-disabled', $data);
    }
}
