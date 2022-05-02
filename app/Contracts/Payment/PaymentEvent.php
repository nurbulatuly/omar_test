<?php

namespace App\Contracts\Payment;

interface PaymentEvent
{
    public function getPayment(): Payment;
}
