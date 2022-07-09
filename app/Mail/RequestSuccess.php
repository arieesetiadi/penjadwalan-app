<?php

namespace App\Mail;

use App\Models\Room;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestSuccess extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request;
    public $borrower;

    public function __construct($request, $borrowerId)
    {
        $this->request = $request;
        $this->borrower = User::getById($borrowerId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'request' => $this->request,
            'room' => Room::find($this->request['room'])->name
        ];

        return $this
            ->to($this->borrower)
            ->subject('Anda Berhasil Melakukan Pengajuan Jadwal')
            ->view('email.request-success', $data);
    }
}
