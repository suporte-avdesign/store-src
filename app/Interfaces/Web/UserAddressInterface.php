<?php

namespace AVD\Interfaces\Web;

interface UserAddressInterface
{
    /**
     * Interface model UserAddress
     *
     * @return \AVD\Repositories\Web\UserAddressRepository
     */
    public function create($input);

}