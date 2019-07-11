<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigShipping as Model;
use AVD\Interfaces\Web\ConfigShippingInterface;

class ConfigShippingRepository implements ConfigShippingInterface
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
     * @param $input
     * @return bool
     */
    public function getAll()
    {
        return $this->model->orderBy('order')->where('active', constLang('active_true'))->get();
    }


    public function setId($id)
    {
        return $this->model->find($id);
    }

}