<?php

namespace AVD\Interfaces\Web;

interface PaymentCompanyInterface
{
    /**
     * Interface model PaymentCompany
     *
     * @return \AVD\Repositories\Web\PaymentCompanyRepository
     */
    public function getCash();
    public function getBillet();
    public function getCredit();
    public function getDebit();

}