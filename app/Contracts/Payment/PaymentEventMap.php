<?php

namespace App\Contracts\Payment;

interface PaymentEventMap
{
    public function ifCurrentStatusIs(PaymentStatus $status): self;

    public function andOldStatusIs(PaymentStatus $status): self;

    public function thenFireEvents(): array;
}
