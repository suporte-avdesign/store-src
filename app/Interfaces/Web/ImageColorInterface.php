<?php

namespace AVD\Interfaces\Web;

interface ImageColorInterface
{
    /**
     * Interface model ImageColor
     *
     * @return \AVD\Repositories\Web\ImageColorRepository
     */
    public function get($slug);
    public function search($search);

}