<?php

namespace AVD\Interfaces\Web;

interface OrderItemInterface
{
    /**
     * Interface model OrderItem
     *
     * @return \AVD\Repositories\Web\OrderItemRepository
     */
    public function create($cart, $order_id);

}