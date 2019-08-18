<?php

namespace AVD\Listeners;

use AVD\Events\UserRegisteredNewsletterEvent;
use AVD\Interfaces\Web\NewsletterInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredNewsletterListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * @var NewsletterInterface
     */
    private $newsletter;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NewsletterInterface $newsletter)
    {

        $this->newsletter = $newsletter;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredNewsletterEvent  $event
     * @return void
     */
    public function handle(UserRegisteredNewsletterEvent $event)
    {
        $user    = $event->getUser();
        $address = $user->adresses()->orderBy('id', 'desc')->first();
        $day     = date('d', strtotime($user->date));
        $month   = date('m', strtotime($user->date));
        $name    = $user->profile_id == 1 ? $user->last_name : $user->first_name;
        $profile = $user->profile_id == 1 ? constLang('person_legal.name') : constLang('person_physical.name');

        $input   = [
            'name' => $name,
            'email' => $user->email,
            'profile' => $profile,
            'type' => $user->type_id,
            'city' => $address->city,
            'state' => $address->state,
            'zip_code' => $address->zip_code,
            'latitude' => 'Falta fazer',
            'longitude' => 'Falta fazer',
            'day' => $day,
            'month' => $month,
            'active' => $user->newsletter,
        ];

        $this->newsletter->create($input);
    }
}
