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
    public $officer;

    public function __construct($request, $borrowerId, $officer)
    {
        $this->request = $request;
        $this->borrower = User::getById($borrowerId);
        $this->officer = $officer;
    }

    public function build()
    {
        $data = [
            'request' => $this->request,
            'borrower' => $this->borrower,
        ];

        return $this
            ->to($this->officer)
            ->subject('Pengajuan Jadwal')
            ->view('email.schedule-requested', $data);
    }
}
