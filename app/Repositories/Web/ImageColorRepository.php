<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\ImageColor as Model;
use AVD\Interfaces\Web\ImageColorInterface;

class ImageColorRepository implements ImageColorInterface
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
     * @param $slug
     * @return mixed
     */
    public function get($slug)
    {
        $query = $this->model->where(['active' => constLang('active_true'), 'slug' => $slug])
            ->with([
                'product' => function ($query)  {
                    $query->where('active', 1)->with([
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
                        },
                    ]);
                },
                'positions' => function ($query) {
                    $query->orderBy('order')->where('active', constLang('active_true'))->get();
                },
                'grids' => function ($query) {
                    $query->where('grid', '!=', null)->get();
                }

            ])->first();

        return $query;

    }





}