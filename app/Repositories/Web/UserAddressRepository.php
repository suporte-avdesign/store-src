<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\UserAddress as Model;
use AVD\Interfaces\Web\UserAddressInterface;


class UserAddressRepository implements UserAddressInterface
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
    public function create($input)
    {
        return $this->model->create($input);
    }


}