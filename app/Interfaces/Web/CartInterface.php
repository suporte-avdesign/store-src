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
    public function update($input, $id);
    public function delete($id);
    public function getall($session);
    public function existProduct($session, $grid_product_id);

}