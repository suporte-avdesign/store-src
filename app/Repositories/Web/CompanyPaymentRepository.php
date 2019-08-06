<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\CompanyPayment as Model;
use AVD\Interfaces\Web\CompanyPaymentInterface;


class CompanyPaymentRepository implements CompanyPaymentInterface
{

    public $model;

    /**
     * Create construct.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getCash()
    {
        return $this->model->where('cash',1)->firstOrFail();
    }

    public function getBillet()
    {
        return $this->model->where('billet',1)->firstOrFail();
    }

    public function getCardCred()
    {
        return $this->model->where('credit_card',1)->firstOrFail();
    }

    public function getCardDebit()
    {
        return $this->model->where('debit_card',1)->firstOrFail();
    }



}