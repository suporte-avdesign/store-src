<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\PaymentBillet as Model;
use AVD\Interfaces\Web\PaymentBilletInterface;


class PaymentBilletRepository implements PaymentBilletInterface
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