<?php

namespace AVD\Interfaces\Web;

interface OrderInterface
{
    /**
     * Interface model Order
     *
     * @return \AVD\Repositories\Web\OrderRepository
     */
    public function newOrder($reference, $token);
    public function create($cart, $freight, $payment, $shipping, $company, $status, $reference, $code);

}