<?php

namespace AVD\Listeners;

use AVD\Events\UserRegisteredEvent;
use AVD\Mail\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredSendMailListener implements ShouldQueue
{
    use InteractsWithQueue;


    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(UserRegisteredEvent $event)
    {
        $user = $event->getUser();
        $url  = route('register.confirm',['email' => $user->email, 'token' =>$user->token]);

        \Mail::to($user)->send(new UserRegistered($user, $url));

    }
}
