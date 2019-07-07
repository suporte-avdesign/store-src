<?php

namespace AVD\Listeners;

use AVD\Mail\UserRegisterConfirmed;
use AVD\Events\UserRegisterConfirmedEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterConfirmedListener implements ShouldQueue
{
    use InteractsWithQueue;


    /**
     * Handle the event.
     *
     * @param  UserRegisterConfirmedEvent  $event
     * @return void
     */
    public function handle(UserRegisterConfirmedEvent $event)
    {
        $user = $event->getUser();

        \Mail::to($user)->send(new UserRegisterConfirmed($user));

    }
}
