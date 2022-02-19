<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastNotes extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $users;
    public $note;
    public $imageName;
    public $fileName;

    public function __construct($note, $imageName, $fileName)
    {
        $this->users = User::all();
        $this->note = $note;
        $this->imageName = $imageName;
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'note' => $this->note,
            'imageName' => $this->imageName,
            'fileName' => $this->fileName
        ];

        $mail =  $this
            ->from(User::getById(auth()->user()->id))
            ->bcc($this->users)
            ->subject('Broadcast Notulen')
            ->attach(public_path('uploaded\images\\') . '1645107352_screenshot (3).png')
            ->attach(public_path('uploaded\files\\') . '1645107352_bukti follow af.pdf')
            ->view('email.broadcast-notes', $data);

        return $mail;
    }
}
