<?php

namespace AVD\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $subject, $message)
    {
        $this->name    = $name;
        $this->email   = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name    = $this->name;
        $email   = $this->email;
        $subject = $this->subject;
        $message = $this->message;

        return $this
            ->subject($this->subject)
            ->markdown('frontend.emails.contacts.subjects', compact(
                'name', 'email','subject', 'message')
            );
    }
}
