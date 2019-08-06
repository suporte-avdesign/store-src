<?php

namespace AVD\Interfaces\Web;

interface OrderShippingInterface
{
    /**
     * Interface model OrderShipping
     *
     * @return \AVD\Repositories\Web\OrderShippingRepository
     */
    public function create($input, $order_id);

}