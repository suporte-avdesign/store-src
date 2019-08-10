<?php

namespace AVD\Interfaces\Web;

interface PaymentCashInterface
{
    /**
     * Interface model PaymentCash
     *
     * @return \AVD\Repositories\Web\PaymentCashRepository
     */
    public function create($input);

}