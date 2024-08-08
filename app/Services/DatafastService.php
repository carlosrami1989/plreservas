<?php

namespace App\Services;

use App\Libraries\Datafast;

class DatafastService
{
    protected $datafast;

    public function __construct()
    {
        $this->datafast = new Datafast(
            env('DATAFAST_ENTITY_ID'),
            env('DATAFAST_AUTHORIZATION'),
            env('DATAFAST_BASE_URL')
        );
    }

    public function createCheckout($amount, $currency)
    {
        return $this->datafast->getCheckoutId($amount, $currency);
    }

    public function getPaymentStatus($resourcePath)
    {
        return $this->datafast->getPaymentStatus($resourcePath);
    }
}
