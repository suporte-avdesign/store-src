<?php

namespace AVD\Mail;

use AVD\Models\Web\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckoutRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;
    /**
     * @var
     */
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $url)
    {

        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->url;

        return $this
            ->subject('Confirme sua conta na '.config('app.name'))
            ->markdown('frontend.emails.users.checkout-registered');
    }
}
