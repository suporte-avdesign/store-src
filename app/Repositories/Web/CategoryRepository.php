<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Category as Model;
use AVD\Interfaces\Web\CategoryInterface;

class CategoryRepository implements CategoryInterface
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
     * Date; 06/30/2019
     *
     * @param $configSite
     * @param $configProduct
     * @param $id
     * @return mixed
     */
    public function getSectionProducts($configSite, $configProduct, $id)
    {
        $query = $this->model->orderBy('name')->where(['active' => constLang('active_true'), 'section_id' => $id])
            ->with([
                'products' => function ($query) use ($configSite, $configProduct) {
                    if ($configSite->order_products == 'random') {
                        $query->inRandomOrder()->where('active', 1)->with([
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
                            }
                        ])->get();
                    } else {
                        $query->orderBy('id', $configSite->order_products)
                            ->where('active', 1)->get();
                    }
                }
            ])
            ->get();

        return $query;

    }


    public function getSectionColors($configSite, $configProduct, $id)
    {
        $query = $this->model->orderBy('name')->where(['active' => constLang('active_true'), 'section_id' => $id])
            ->with([
                'products' => function ($query) use ($configSite, $configProduct) {
                    $query->where('active', 1)->with([
                        'prices' => function ($query) {
                            $query->where('price_cash', '!=', null)->get();
                        },
                        'images' => function ($query) use($configSite, $configProduct) {
                            if ($configSite->order_products == 'random') {
                                $query->inRandomOrder()->orderBy('cover', 'desc')->where('active', constLang('active_true'))->with([
                                    'positions' => function ($query) {
                                        $query->orderBy('order')->where('active', constLang('active_true'))->get();
                                    },
                                    'grids' => function ($query) {
                                        $query->where('grid', '!=', null)->get();
                                    }
                                ])->get();
                            } else {
                                $query->orderBy('id', $configSite->order_products)
                                    ->orderBy('cover', 'desc')->where('active', constLang('active_true'))->get();
                            }
                        }
                    ]);
                }

            ])->get();

        return $query;

    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getProducts($configSite, $configProduct, $slug)
    {
        $query = $this->model->orderBy('name')->where(['active' => constLang('active_true'), 'slug' => $slug])
            ->with([
                'products' => function ($query) use ($configSite, $configProduct) {
                    if ($configSite->order_products == 'random') {
                        $query->inRandomOrder()->where('active', 1)->with([
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
                                }
                            ])->get();
                    } else {
                        $query->orderBy('id', $configSite->order_products)->where('active', 1)->get();
                    }
                }
            ])
            ->first();


        return $query;
    }


    public function getColors($configSite, $configProduct, $slug)
    {
        $query = $this->model->orderBy('name')->where(['active' => constLang('active_true'), 'slug' => $slug])
            ->with([
                'products' => function ($query) use ($configSite, $configProduct) {
                    $query->where('active', 1)->with([
                        'prices' => function ($query) {
                            $query->where('price_cash', '!=', null)->get();
                        },
                        'images' => function ($query) use($configSite, $configProduct) {
                            if ($configSite->order_products == 'random') {
                                $query->inRandomOrder()->orderBy('cover', 'desc')->where('active', constLang('active_true'))->with([
                                        'positions' => function ($query) {
                                            $query->orderBy('order')->where('active', constLang('active_true'))->get();
                                        },
                                        'grids' => function ($query) {
                                            $query->where('grid', '!=', null)->get();
                                        }
                                    ])->get();
                            } else {
                                $query->orderBy('id', $configSite->order_products)
                                    ->orderBy('cover', 'desc')->where('active', constLang('active_true'))->get();
                            }
                        }
                    ]);
                }

            ])->first();

        return $query;
    }



}