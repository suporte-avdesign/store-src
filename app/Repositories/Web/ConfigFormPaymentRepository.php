<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigFormPayment as Model;
use AVD\Interfaces\Web\ConfigFormPaymentInterface;

class ConfigFormPaymentRepository implements ConfigFormPaymentInterface
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
     * Date: 07/01/2019
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('order')->where('active', constLang('active_true'))->get();
    }

}