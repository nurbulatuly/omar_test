<?php

namespace App\Events\Payment;

use App\Contracts\Payment\Payment;

class PaymentPartiallyReceived extends BasePaymentEvent
{
    public float $amountPaid;

    public function __construct(Payment $payment, float $amountPaid)
    {
        parent::__construct($payment);
        $this->amountPaid = $amountPaid;
    }
}
