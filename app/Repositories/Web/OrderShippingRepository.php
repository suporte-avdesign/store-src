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
        $dataForm = [
            'order_id' => $order_id,
            'user_id' => auth()->id(),
            'config_shipping_id' => 6,
            'indicate' => $input['indicate'],
            'phone' => $input['phone'],
            'name' => $input['name']
        ];
        return $this->model->create($dataForm);
    }


}