<?php

namespace AVD\Events;


class UserRegisteredNoteEvent
{
    /**
     * @var UserNoteInterface
     */
    private $note;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($note)
    {

        $this->note = $note;
    }

    /**
     * @return UserNoteInterface
     */
    public function getNote()
    {
        return $this->note;
    }
}
