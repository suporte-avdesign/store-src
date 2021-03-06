<?php

namespace AVD\Interfaces\Web;

interface ProductInterface
{
    /**
     * Interface model Product
     *
     * @return \AVD\Repositories\Web\ProductRepository
     */
    public function getId($id);
    public function setId($id);

}