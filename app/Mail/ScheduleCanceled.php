<?php

namespace App\Mail;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleCanceled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $schedule;
    protected $officers;
    protected $cancelMessage;
    protected $mailSubject;

    public function __construct($scheduleId, $request)
    {
        $this->schedule = Schedule::getById($scheduleId)[0];
        $this->officers = User::getOfficers();
        $this->cancelMessage = $request->cancelMessage;
        $this->mailSubject = $request->subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->bcc($this->officers)
            ->subject($this->mailSubject)
            ->view('email.schedule-canceled' , [
                'schedule' => $this->schedule,
                'cancelMessage' => $this->cancelMessage,
                'subject' => $this->mailSubject
            ]);
    }
}
