<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigColorPosition as Model;
use AVD\Interfaces\Web\ConfigColorPositionInterface;

class ConfigColorPositionRepository implements ConfigColorPositionInterface
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
     * Init Model
     *
     * @return array
     */
    public function getAll()
    {
        return $this->model->get();
    }


    /**
     * Set Name
     *
     * @param  string  $field
     * @param  string  $name
     * @return array
     */
    public function setName($field, $name)
    {
        return $this->model->where($field, $name)->first();
    }



}