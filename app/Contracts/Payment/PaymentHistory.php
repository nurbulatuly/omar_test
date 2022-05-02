<?php

namespace App\Contracts\Payment;

interface PaymentHistory
{
    public static function begin(Payment $payment): PaymentHistory;

    public static function addPaymentResponse(
        Payment $payment,
        PaymentResponse $response,
        PaymentStatus $oldStatus = null
    ): PaymentHistory;
}
