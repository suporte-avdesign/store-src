<?php

namespace AVD\Listeners;

use AVD\Mail\SendContact;
use AVD\Events\SendContactEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactListener implements ShouldQueue
{
    use InteractsWithQueue;


    /**
     * Handle the event.
     *
     * @param  UserRegisteredEvent  $event
     * @return void
     */
    public function handle(SendContactEvent $event)
    {
        $name    = $event->getName();
        $email   = $event->getEmail();
        $subject = $event->getSubject();
        $message = $event->getMessage();

        \Mail::to($email)->send(new SendContact($email, $name, $subject, $message));

    }
}
