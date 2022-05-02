<?php

namespace App\Contracts\Payment;

interface PaymentRequest
{
    /* Returns the html snippet to be rendered for initiating the payment */
    public function getHtmlSnippet(array $options = []): ?string;

    public function willRedirect(): bool;
}
