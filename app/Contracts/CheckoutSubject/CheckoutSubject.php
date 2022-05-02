<?php

namespace App\Contracts\CheckoutSubject;

use Illuminate\Support\Collection;

interface CheckoutSubject
{
    /**
     * A collection of CheckoutSubjectItem objects
     */
    public function getItems(): Collection;

    /**
     * Returns the final total of the CheckoutSubject (typically a cart)
     */
    public function total(): float;
}
