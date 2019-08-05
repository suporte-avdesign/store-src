<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\Cart as Model;
use AVD\Interfaces\Web\CartInterface;

class CartRepository implements CartInterface
{

    public $model;
    public $session;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model   = $model;
        $this->session = md5($_SERVER['REMOTE_ADDR']);;
    }

    /**
     * Date: 07/01/2019
     *
     * @param $session
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderBy('id')->where('session', $this->session)->get();
    }

    /**
     * Date: 07/02/2019
     *
     * @param $cart
     * @return mixed
     */
    public function getTotal($cart)
    {
        $quantity   = 0;
        $price_cash = 0;
        $price_card = 0;
        foreach ($cart as $item) {
            $quantity   += $item->quantity;
            $price_cash += $item->price_cash * $item->quantity;
            $price_card += $item->price_card * $item->quantity;
        }

        $total['quantity']   = $quantity;
        $total['price_cash'] = $price_cash;
        $total['price_card'] = $price_card;

        return $total;

    }

    public function totalItems()
    {
        return $this->model->where('session', $this->session)->count();
    }




    /**
     * Date: 07/04/2019
     *
     * @param $key
     * @return mixed
     */
    public function setKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    /**
     * Date: 07/01/2019
     *
     * @param $session
     * @param $grid_product_id
     * @return mixed
     */
    public function existProduct($grid_product_id)
    {
        return $this->model->where(['grid_product_id' => $grid_product_id, 'session' => $this->session])->first();
    }

    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @return bool
     */
    public function create($input)
    {
        return $this->model->create($input);
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
        $data = $this->model->find($key);
        return $data->update($input);
    }

    /**
     * Date: 07/01/2019
     *
     * @param $input
     * @param $id
     * @return bool
     */
    public function updateAll($input)
    {
        $upds = true;
        foreach ($input as $key => $values) {
            foreach ($values as $qty => $value) {
                if ($value <= 0) {
                    $delete = $this->delete($key);
                } else {
                    $data = $this->setKey($key);
                    if ($data->quantity != $value) {
                        $item = ['quantity' => $value];
                        $upds = $data->update($item);
                    }
                }
            }
        }
        return $upds;
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


}