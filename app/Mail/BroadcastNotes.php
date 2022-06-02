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
    public $imageNames;
    public $fileNames;

    public function __construct($note, $imageNames, $fileNames)
    {
        $this->users = User::all();
        $this->note = $note;
        $this->imageNames = $imageNames;
        $this->fileNames = $fileNames;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail =  $this
            ->bcc($this->users)
            ->subject('Broadcast Notulen')
            ->view('email.broadcast-notes', ['note' => $this->note]);

        // Kirim gambar jika ada
        if ($this->imageNames) {
            $imageNames = str($this->imageNames)->explode('|');

            // Looping semua gambar sebagai attachment pada email
            for ($i = 0; $i < count($imageNames) - 1; $i++) {
                $mail = $mail->attach(public_path('uploaded\images\\') . $imageNames[$i]);
            }
        }

        // Kirim file jika ada
        if ($this->fileNames) {
            $fileNames = str($this->fileNames)->explode('|');

            // Looping semua file sebagai attachment pada email
            for ($i = 0; $i < count($fileNames) - 1; $i++) {
                $mail = $mail->attach(public_path('uploaded\files\\') . $fileNames[$i]);
            }
        }

        return $mail;
    }
}
