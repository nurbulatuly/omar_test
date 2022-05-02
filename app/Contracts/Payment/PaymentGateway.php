<?php

namespace App\Contracts\Payment;

interface PaymentGateway
{
    public static function getName(): string;

    public function createPaymentRequest(
        Payment $payment,
        Address $shippingAddress = null,
        array $options = []
    ): PaymentRequest;

    public function processPaymentResponse(Request $request, array $options = []): PaymentResponse;

    public function isOffline(): bool;
}
