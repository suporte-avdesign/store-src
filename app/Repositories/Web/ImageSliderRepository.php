<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ImageSlider as Model;
use AVD\Interfaces\Web\ImageSliderInterface;


class ImageSliderRepository implements ImageSliderInterface
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
    public function getAll($type)
    {
        return $this->model
            ->orderBy('order')
            ->where(['type' => $type, 'active' => constLang('active_true')])
            ->get();
    }


}