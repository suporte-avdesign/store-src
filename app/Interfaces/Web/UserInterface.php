<?php

namespace AVD\Interfaces\Web;

interface UserInterface
{
    /**
     * Interface model User
     *
     * @return \AVD\Repositories\Web\UserRepository
     */
    public function setId($id);
    public function setEmail($email);
    public function create($input);
}