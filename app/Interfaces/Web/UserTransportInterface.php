<?php

namespace AVD\Interfaces\Web;

interface UserTransportInterface
{
    /**
     * Interface model UserTransport
     *
     * @return \AVD\Repositories\Web\UserTransportRepository
     */
    public function create($input);

}