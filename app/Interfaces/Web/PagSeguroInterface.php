<?php

namespace AVD\Interfaces\Web;

interface PagSeguroInterface
{
    /**
     * Interface model PagSeguro
     *
     * @return \AVD\Repositories\Web\PagSeguroRepository
     */
    public function generate();
    public function getSessionId();
    public function paymentBillet($senderHash);
    public function paymentCredCard($request);

}