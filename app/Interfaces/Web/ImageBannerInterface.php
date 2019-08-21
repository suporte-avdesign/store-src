<?php

namespace AVD\Interfaces\Web;

interface ImageBannerInterface
{
    /**
     * Interface model ImageBanner
     *
     * @return \AVD\Repositories\Web\ImageBannerRepository
     */
    public function getAll($type);

}