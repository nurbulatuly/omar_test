<?php

namespace App\Contracts;

interface Billpayer extends Customer
{
    /**
     * Returns the billing address
     */
    public function getBillingAddress(): Address;
}
