<?php

namespace AVD\Interfaces\Web;

interface OrderInterface
{
    /**
     * Interface model Order
     *
     * @return \AVD\Repositories\Web\OrderRepository
     */
    public function setToken($code, $token);
    public function create($cart, $freight, $payment, $shipping, $company, $status);

}