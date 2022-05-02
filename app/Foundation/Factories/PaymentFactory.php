<?php

namespace App\Foundation\Factories;

use App\Contracts\Payable;
use App\Contracts\Payment\Payment;
use App\Contracts\Payment\PaymentMethod;
use App\Events\Payment\PaymentCreated;

class PaymentFactory
{
    public static function createFromPayable(
        Payable $payable,
        PaymentMethod $paymentMethod,
        array $extraData = []
    ): Payment {
        $payment = PaymentProxy::create([
            'amount' => $payable->getAmount(),
            'currency' => $payable->getCurrency(),
            'payable_type' => $payable->getPayableType(),
            'payable_id' => $payable->getPayableId(),
            'payment_method_id' => $paymentMethod->id,
            'data' => $extraData
        ]);

        event(new PaymentCreated($payment));

        return $payment;
    }
}
