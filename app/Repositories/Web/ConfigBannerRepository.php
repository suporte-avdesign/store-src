<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigBanner as Model;
use AVD\Interfaces\Web\ConfigBannerInterface;


class ConfigBannerRepository implements ConfigBannerInterface
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