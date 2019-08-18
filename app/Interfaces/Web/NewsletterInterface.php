<?php

namespace AVD\Interfaces\Web;

interface NewsletterInterface
{
    /**
     * Interface model Newsletter
     *
     * @return \AVD\Repositories\Web\NewsletterRepository
     */
    public function create($input);
    public function update($input);
    public function delete($input);
    public function exist($input);

}