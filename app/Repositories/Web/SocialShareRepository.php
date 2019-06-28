<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\SocialShare as Model;
use AVD\Interfaces\Web\SocialShareInterface;

class SocialShareRepository implements SocialShareInterface
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
    public function getAll()
    {
        return $this->model->get();
    }



}