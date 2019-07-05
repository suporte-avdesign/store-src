<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\AccountType as Model;
use AVD\Interfaces\Web\AccountTypeInterface;

class AccountTypeRepository implements AccountTypeInterface
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
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->get();
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