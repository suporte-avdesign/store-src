<?php

namespace AVD\Interfaces\Web;

interface ConfigKeywordInterface
{
    /**
     * Interface model ConfigKeyword
     *
     * @return \AVD\Repositories\Web\ConfigKeywordRepository
     */
    public function random();
    public function routeSection();
    public function routeCategory();
    public function routeProduct();


}