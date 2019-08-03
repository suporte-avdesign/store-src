<?php

namespace AVD\Interfaces\Web;

interface ConfigProfileClientInterface
{
    /**
     * Interface model ConfigProfileClient
     *
     * @return \AVD\Repositories\Web\ConfigProfileClientRepository
     */
    public function getAll();
    public function setId($id);
    public function getName($id);
}