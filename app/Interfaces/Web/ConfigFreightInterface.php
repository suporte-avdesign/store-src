<?php

namespace AVD\Interfaces\Web;

interface ConfigFreightInterface
{
    /**
     * Interface model ConfigFreight
     *
     * @return \AVD\Repositories\Web\ConfigFreightRepository
     */
    public function setId($id);
    public function pac($postcode, $input);
    public function sedex($postcode, $input);

}