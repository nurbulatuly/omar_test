<?php

namespace App\Events\Payment;

use App\Contracts\Payment\Payment;

class BasePaymentEvent implements PaymentEvent
{
    use HasPayment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}
