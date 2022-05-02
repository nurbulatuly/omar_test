<?php

namespace App\Contracts\Payment;

interface PaymentResponse
{
    public function wasSuccessful(): bool;

    public function getMessage(): ?string;

    public function getTransactionId(): ?string;

    public function getAmountPaid(): ?float;

    public function getPaymentId(): string;

    public function getStatus(): PaymentStatus;

    public function getNativeStatus(): Enum;
}
