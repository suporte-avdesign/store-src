<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\PaymentCard as Model;
use AVD\Interfaces\Web\PaymentCardInterface;


class PaymentCardRepository implements PaymentCardInterface
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
    public function create($input)
    {
        return $this->model->create($input);
    }


}