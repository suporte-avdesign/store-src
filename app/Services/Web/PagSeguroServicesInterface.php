<?php

namespace AVD\Services\Web;

interface PagSeguroServicesInterface
{
    /**
     * Interface model PagSeguroServices
     *
     * @return \AVD\Services\Web\PagSeguroServices
     */
    public function generate();
    public function getSessionId();
    public function paymentBillet($senderHash);
    public function paymentCredCard($request);

}