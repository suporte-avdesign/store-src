<?php

namespace AVD\Interfaces\Web;

interface ConfigColorPositionInterface
{
    /**
     * Interface model ConfigColorPosition
     *
     * @return \AVD\Repositories\ConfigColorPositionRepository
     */
    public function getAll();
    public function setName($field, $name);

}