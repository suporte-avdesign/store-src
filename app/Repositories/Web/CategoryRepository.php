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
     * @param $slug
     * @return mixed
     */
    public function getAll($configSite, $configProduct, $id)
    {

        $query = $this->model->orderBy('name')->where(['active' => constLang('active_true'), 'section_id' => $id])
            ->with([
                'products' => function ($query) use ($configSite, $configProduct) {

                    if ($configSite->order_products == 'random') {
                        $query->inRandomOrder()->where('active', 1)
                            ->limit($configSite->limit_products)->with([
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
                            ]);
                    } else {
                        $query->orderBy('id', $configSite->order_products)
                            ->where('active', 1)
                            ->limit($configSite->limit_products);
                    }




                }
            ])
            ->get();


        return $query;

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

    /**
     * @param $slug
     * @return mixed
     */
    public function get($slug)
    {
        return $this->model->where(['active' => constLang('active_true'), 'slug' => $slug])->first();
    }



}