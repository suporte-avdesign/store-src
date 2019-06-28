<?php

namespace AVD\Interfaces\Web;

interface CategoryInterface
{
    /**
     * Interface model Category
     *
     * @return \AVD\Repositories\Web\CategoryRepository
     */
    public function setId($id);
    public function get($slug);
    public function getAll($configSite, $configProduct, $id);

}