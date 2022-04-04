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
            'note' => $this->note
        ];

        $mail =  $this
            ->bcc($this->users)
            ->subject('Broadcast Notulen')
            ->view('email.broadcast-notes', $data);

        // Kirim gambar jika ada
        if ($this->imageName) {
            $mail = $mail->attach(public_path('uploaded\images\\') . $this->imageName);
        }

        // Kirim file jika ada
        if ($this->fileName) {
            $mail = $mail->attach(public_path('uploaded\files\\') . $this->fileName);
        }

        return $mail;
    }
}
