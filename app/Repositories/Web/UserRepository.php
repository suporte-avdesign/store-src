<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\User as Model;
use AVD\Interfaces\Web\UserInterface;

class UserRepository implements UserInterface
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
     * @param  int Id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    public function setEmail($email)
    {
        return $this->model->where('email', $email)->first();
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