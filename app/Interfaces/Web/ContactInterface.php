<?php

namespace AVD\Interfaces\Web;

interface ContactInterface
{
    /**
     * Interface model Contact
     *
     * @return \AVD\Repositories\Web\ContactRepository
     */
    public function create($input);

}