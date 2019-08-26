<?php

namespace AVD\Interfaces\Web;

interface OrderInterface
{
    /**
     * Interface model Order
     *
     * @return \AVD\Repositories\Web\OrderRepository
     */
    public function getAll($user);
    public function newOrder($reference, $token);
    public function setOrder($user, $reference);
    public function create($cart, $freight, $payment, $shipping, $company, $status, $reference, $code);

}