<?php

namespace AVD\Listeners;

use AVD\Mail\CheckoutRegistered;
use AVD\Events\UserRegisteredCheckoutEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredCheckoutSendMailListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  UserRegisteredCheckoutEvent  $event
     * @return void
     */
    public function handle(UserRegisteredCheckoutEvent $event)
    {
        $user = $event->getUser();
        $url  = route('checkout.confirm',['email' => $user->email, 'token' =>$user->token]);

        \Mail::to($user)->send(new CheckoutRegistered($user, $url));
    }
}
