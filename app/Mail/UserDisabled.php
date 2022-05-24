<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserDisabled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $msg;

    public function __construct($userId, $msg)
    {
        $this->user = User::find($userId);
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'user' => $this->user,
            'msg' => $this->msg
        ];

        return $this
            ->to($this->user)
            ->subject('Akun Anda Telah Dinonaktifkan')
            ->view('email.user-disabled', $data);
    }
}
