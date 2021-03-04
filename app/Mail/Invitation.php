<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Token;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient_name;
    public $optional_message;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient_name, $optional_message, Token $token)
    {
        $this->recipient_name = $recipient_name;
        $this->optional_message = $optional_message;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitation');
    }
}
