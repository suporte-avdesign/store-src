<?php

namespace AVD\Interfaces\Web;

interface CompanyPaymentInterface
{
    /**
     * Interface model CompanyPayment
     *
     * @return \AVD\Repositories\Web\CompanyPaymentRepository
     */
    public function getCash();
    public function getBillet();
    public function getCardCred();
    public function getCardDebit();

}