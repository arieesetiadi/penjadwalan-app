<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $borrower;
    public $officers;

    public function __construct($request, $borrowerId)
    {
        $this->request = $request;
        $this->borrower = User::getById($borrowerId);
        $this->officers = User::getOfficers();
    }

    public function build()
    {
        $data = [
            'request' => $this->request,
            'borrower' => $this->borrower,
        ];

        return $this
            ->from($this->borrower->only('email', 'name'))
            ->bcc($this->officers)
            ->subject('Pengajuan Jadwal')
            ->view('email.schedule-requested', $data);
    }
}
