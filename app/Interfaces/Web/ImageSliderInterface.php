<?php

namespace AVD\Interfaces\Web;

interface ImageSliderInterface
{
    /**
     * Interface model ImageSlider
     *
     * @return \AVD\Repositories\Web\ImageSliderRepository
     */
    public function getAll($type);

}