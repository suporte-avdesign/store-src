<?php

namespace AVD\Listeners;

use AVD\Events\UserRegisteredNoteEvent;
use AVD\Interfaces\Web\UserNoteInterface;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredNoteListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var UserNoteInterface
     */
    private $userNote;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserNoteInterface $userNote)
    {
        $this->userNote = $userNote;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisteredNoteEvent  $event
     * @return void
     */
    public function handle(UserRegisteredNoteEvent $event)
    {
        sleep(20);
        $note = $event->getNote();
        $this->userNote->create($note);
    }
}
