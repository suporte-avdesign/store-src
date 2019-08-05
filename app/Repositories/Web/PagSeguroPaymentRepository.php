<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\PagSeguroPayment as Model;
use AVD\Interfaces\Web\PagSeguroPaymentInterface;


class PagSeguroPaymentRepository implements PagSeguroPaymentInterface
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
    public function paymentBillet($input)
    {
        return $this->model->create($input);
    }


    public function paymentCredCard($input)
    {
        return $this->model->create($input);
    }


}