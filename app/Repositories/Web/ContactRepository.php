<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Contact as Model;
use AVD\Interfaces\Web\ContactInterface;

class ContactRepository implements ContactInterface
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
    public function create($input)
    {
        return $this->model->create($input);
    }


}