<?php

namespace AVD\Interfaces\Web;

interface AccountTypeInterface
{
    /**
     * Interface model AccountType
     *
     * @return \AVD\Repositories\Web\AccountTypeRepository
     */
    public function getAll();
    public function setId($id);
}