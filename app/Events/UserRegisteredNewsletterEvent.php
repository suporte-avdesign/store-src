<?php

namespace AVD\Events;


class UserRegisteredNewsletterEvent
{
    private $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
