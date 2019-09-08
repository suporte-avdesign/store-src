<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ContentFaq as Model;
use AVD\Interfaces\Web\ContentFaqInterface;

class ContentFaqRepository implements ContentFaqInterface
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
        return $this->model->orderBy('order')->where('active', constLang('active_true'))->get();
    }



}