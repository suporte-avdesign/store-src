<?php

namespace AVD\Interfaces\Web;

interface PaymentCardInterface
{
    /**
     * Interface model PaymentCard
     *
     * @return \AVD\Repositories\Web\PaymentCardRepository
     */
    public function create($input);

}