<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Cart as Model;
use AVD\Interfaces\Web\CartInterface;

class CartRepository implements CartInterface
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
     * @param $session
     * @return mixed
     */
    public function getAll($session)
    {
        return $this->model->where('session', $session)->get();
    }




    /**
     * Date: 07/01/2019
     *
     * @param $session
     * @param $grid_product_id
     * @return mixed
     */
    public function existProduct($session, $grid_product_id)
    {
        return $this->model->where(['grid_product_id' => $grid_product_id, 'session' => $session])->first();
    }

    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @return bool
     */
    public function create($input)
    {
        $data = $this->model->create($input);
        if ($data) {
            return $data;
        }

        return false;
    }

    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @param $id
     * @return bool
     */
    public function update($input, $key)
    {
        $data   = $this->model->find($key);
        return $data->update($input);
    }

    /**
     * Date: 07/01/2019
     *
     * @param $id
     * @return bool
     */
    public function delete($key)
    {
        $data = $this->model->where('key', $key)->first();
        return $data->delete();
    }


    /**
     * Date: 07/04/2019
     *
     * @param $key
     * @return mixed
     */
    public function undo($key)
    {
        return $this->model->where('key', $key)->first();
    }


}