<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Product as Model;
use AVD\Interfaces\Web\ProductInterface;

class ProductRepository implements ProductInterface
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
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        return $this->model->find($id);
    }


    /**
     * Date: 06/30/2019
     *
     * @param $id
     * @return mixed
     */
    public function getId($id)
    {
        $query = $this->model->where(['active' => 1, 'id' => $id])->with([
            'prices' => function ($query) {
                $query->where('price_cash', '!=', null)->get();
            },
            'images' => function ($query) {
                $query->orderBy('cover', 'desc')->where('active', constLang('active_true'))->with([
                    'positions' => function ($query) {
                        $query->orderBy('order')->where('active', constLang('active_true'))->get();
                    },
                    'grids' => function ($query) {
                        $query->where('grid', '!=', null)->get();
                    }
                ]);
            },
            'category' => function ($query) {
                $query->where('active', constLang('active_true'))->with([
                    'products' => function ($query) {
                        $query->orderBy('id')->where('active', 1)->with([
                            'prices' => function ($query) {
                                $query->where('price_cash', '!=', null)->get();
                            },
                            'images' => function ($query) {
                                $query->orderBy('cover', 'desc')->where('active', constLang('active_true'))->get();
                            },
                        ])->get();
                    }
                ])->get();
            },
            'section' => function ($query) {
                $query->where('active', constLang('active_true'))->get();
            }

        ])->first();

        return $query;
    }











}