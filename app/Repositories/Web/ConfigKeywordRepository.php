<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ConfigKeyword as Model;
use AVD\Interfaces\Web\ConfigKeywordInterface;
use Illuminate\Support\Str;


class ConfigKeywordRepository implements ConfigKeywordInterface
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
     * Random Model
     *
     * @return array
     */
    public function random()
    {
        return $this->model->inRandomOrder()->first();
    }

    /**
     * Route Category
     *
     * @return string
     */
    public function routeCategory()
    {
        $data = $this->model->find(1);
        $str  = str_replace(',', '/', $data->keywords);
        $exp  = explode('/', $str);
        return Str::slug($exp[0]).'/'.Str::slug($exp[1]).'/';
    }

    /**
     * Route Section
     *
     * @return string
     */
    public function routeSection()
    {
        $data = $this->model->find(2);
        $str  = str_replace(',', '/', $data->keywords);
        $exp  = explode('/', $str);
        return Str::slug($exp[0]).'/'.Str::slug($exp[1]).'/';
    }

    /**
     * Route Product
     * @return string
     */
    public function routeProduct()
    {
        $data = $this->model->find(3);
        $str  = str_replace(',', '/', $data->keywords);
        $exp  = explode('/', $str);
        return Str::slug($exp[0]).'/'.Str::slug($exp[1]).'/';
    }


    /**
     * Route Product
     * @return string
     */
    public function routeColor()
    {
        $data = $this->model->find(4);
        $str  = str_replace(',', '/', $data->keywords);
        $exp  = explode('/', $str);
        return Str::slug($exp[0]).'/'.Str::slug($exp[1]).'/';
    }




}