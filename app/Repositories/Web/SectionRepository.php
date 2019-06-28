<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Section as Model;
use AVD\Interfaces\Web\SectionInterface;

class SectionRepository implements SectionInterface
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
        return $this->model->where('active', constLang('active_true'))->get();
    }


    public function getMenu()
    {
        $query = $this->model->orderBy('order')->where('active', constLang('active_true'))
            ->with([
                'categories' => function ($query) {
                    $query->orderBy('name')->where('active', constLang('active_true'));
                }
            ])
            ->get();

        $collections = collect($query);
/*
        Model::where('types_id', $specialism_id)
            ->withCount(['requests as requests_1' => function ($query) {
                $query->where('type', 1);
            }, 'requests as requests_2' => function ($query) {
                $query->where('type', 2);
            }]);



        /*
        $sections    = $collections;

        foreach ($collections as $section) {
            foreach ($section->categories as $category) {
                foreach ($category->products as $product){
                    $count['new'] = count($product->new);
                    $count['offer'] = count($product->offer);
                    $count['trend'] = count($product->trend);
                    $count['featured'] = count($product->featured);
                    $count['black_friday'] = count($product->black_friday);
                }
            }

        }

*/




        return $collections;

    }



    /**
     * @param $slug
     * @return mixed
     */
    public function get($slug)
    {
        return $this->model->where(['active' => constLang('active_true'), 'slug' => $slug])->first();
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