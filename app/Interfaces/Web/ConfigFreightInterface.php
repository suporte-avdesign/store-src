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
    public function calculateSedex($postcode, $input);
    public function calculatePac($postcode, $input);
    public function calculateUser($postcode, $input);

}