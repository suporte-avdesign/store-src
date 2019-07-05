<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\State as Model;
use AVD\Interfaces\Web\StateInterface;

class StateRepository implements StateInterface
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
        return $this->model->get();
    }

}