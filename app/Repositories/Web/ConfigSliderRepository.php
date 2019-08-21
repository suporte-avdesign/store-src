<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigSlider as Model;
use AVD\Interfaces\Web\ConfigSliderInterface;


class ConfigSliderRepository implements ConfigSliderInterface
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
    public function setId($id)
    {
        return $this->model->find($id);
    }


}