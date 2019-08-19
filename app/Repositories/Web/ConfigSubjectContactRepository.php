<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigSubjectContact as Model;
use AVD\Interfaces\Web\ConfigSubjectContactInterface;


class ConfigSubjectContactRepository implements ConfigSubjectContactInterface
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


    public function setId($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create
     *
     * @param  array $input
     * @return mixed
     */
    public function getAll()
    {
        return $this->model
            ->orderBy('order')
            ->where('active', constLang('active_true'))
            ->get();
    }


}