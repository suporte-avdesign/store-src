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
    public function update($input, $user);
    public function delete($user);

}