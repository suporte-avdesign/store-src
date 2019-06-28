<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigProduct as Model;
use AVD\Interfaces\Web\ConfigProductInterface;


class ConfigProductRepository implements ConfigProductInterface
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }




}