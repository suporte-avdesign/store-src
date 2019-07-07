<?php

namespace AVD\Interfaces\Web;

interface UserNoteInterface
{
    /**
     * Interface model UserNote
     *
     * @return \AVD\Repositories\Web\UserNoteRepository
     */
    public function create($input);

}