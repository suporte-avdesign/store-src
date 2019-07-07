<?php

namespace AVD\Mail;

use AVD\Models\Web\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Seu cadastro foi concluido com sucesso na '.config('app.name'))
            ->markdown('frontend.emails.users.register-confirmed');
    }
}
