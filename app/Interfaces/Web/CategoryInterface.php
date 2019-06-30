<?php

namespace AVD\Interfaces\Web;

interface CategoryInterface
{
    /**
     * Interface model Category
     *
     * @return \AVD\Repositories\Web\CategoryRepository
     */
    public function getProducts($configSite, $configProduct, $slug);
    public function getColors($configSite, $configProduct, $slug);
    public function getSectionProducts($configSite, $configProduct, $id);
    public function getSectionColors($configSite, $configProduct, $id);

}