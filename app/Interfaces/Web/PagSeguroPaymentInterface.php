<?php

namespace AVD\Interfaces\Web;

interface PagSeguroPaymentInterface
{
    /**
     * Interface model PagSeguroPayment
     *
     * @return \AVD\Repositories\Web\PagSeguroPaymentRepository
     */
    public function paymentBillet($input);
    public function paymentCredCard($input);

}