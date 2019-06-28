<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigSite as Model;
use AVD\Interfaces\Web\ConfigSiteInterface;

class ConfigSiteRepository implements ConfigSiteInterface
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
     * Istance
     *
     * @param  int Id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }



}