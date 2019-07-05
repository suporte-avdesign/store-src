<?php

namespace AVD\Interfaces\Web;

interface CartInterface
{
    /**
     * Interface model Cart
     *
     * @return \AVD\Repositories\Web\CartRepository
     */
    public function create($input);
    public function update($input, $key);
    public function delete($key);
    public function undo($key);
    public function getAll($session);
    public function existProduct($session, $grid_product_id);

}