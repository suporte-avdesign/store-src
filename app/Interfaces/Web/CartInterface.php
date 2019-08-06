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
    public function updateAll($input);
    public function destroy();
    public function delete($key);
    public function setKey($key);
    public function getAll();
    public function getTotal($cart);
    public function totalItems();
    public function existProduct($grid_product_id);

}