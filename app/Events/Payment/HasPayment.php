<?php

namespace App\Events\Payment;

use App\Contracts\Payment\Payment;

trait HasPayment
{
    protected Payment $payment;

    public function getPayment(): Payment
    {
        return $this->payment;
    }
}
