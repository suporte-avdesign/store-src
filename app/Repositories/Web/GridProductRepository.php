<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\GridProduct as Model;
use AVD\Interfaces\Web\GridProductInterface;

class GridProductRepository implements GridProductInterface
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
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }

}