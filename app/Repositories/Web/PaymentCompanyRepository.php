<?php

namespace AVD\Repositories\Web;


use AVD\Models\Web\PaymentCompany as Model;
use AVD\Interfaces\Web\PaymentCompanyInterface;


class PaymentCompanyRepository implements PaymentCompanyInterface
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
        return $this->model->where('cash',1)->first();
    }

    public function getBillet()
    {
        return $this->model->where('billet',1)->first();
    }

    public function getCredit()
    {
        return $this->model->where('credit',1)->first();
    }

    public function getDebit()
    {
        return $this->model->where('debit',1)->first();
    }



}