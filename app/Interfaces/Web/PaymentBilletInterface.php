<?php

namespace AVD\Interfaces\Web;

interface PaymentBilletInterface
{
    /**
     * Interface model PaymentBillet
     *
     * @return \AVD\Repositories\Web\PaymentBilletRepository
     */
    public function create($input);

}