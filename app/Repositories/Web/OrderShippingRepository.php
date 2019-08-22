<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\OrderShipping as Model;
use AVD\Interfaces\Web\OrderShippingInterface;


class OrderShippingRepository implements OrderShippingInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function create($input, $order_id)
    {
        return $this->model->create($input);
    }

    public function setOrder($order_id)
    {
        return $this->model->where('order_id', $order_id)->first();
    }


}