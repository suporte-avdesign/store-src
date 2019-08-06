<?php

namespace AVD\Interfaces\Web;

interface OrderInterface
{
    /**
     * Interface model Order
     *
     * @return \AVD\Repositories\Web\OrderRepository
     */
    public function create($cart, $freight, $dataForm, $company);

}