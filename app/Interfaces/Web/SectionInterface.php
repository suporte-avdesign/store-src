<?php

namespace AVD\Interfaces\Web;

interface SectionInterface
{
    /**
     * Interface model Section
     *
     * @return \AVD\Repositories\Web\SectionRepository
     */
    public function getAll();
    public function getMenu();
    public function get($slug);
    public function setId($id);
}