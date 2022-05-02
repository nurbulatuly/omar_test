<?php

namespace App\Contracts;

interface Payable
{
    public function getPayableId(): string;

    public function getPayableType(): string;

    public function getAmount(): float;

    public function getCurrency(): string;

    public function getBillpayer(): ?Billpayer;

    /** The human readable representation, eg.: "Order no. ABC-123" */
    public function getTitle(): string;
}
