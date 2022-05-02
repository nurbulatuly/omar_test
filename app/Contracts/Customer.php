<?php

namespace App\Contracts;

interface Customer
{
    /**
     * Returns the name of the customer (either company or person's name)
     */
    public function getName(): string;
}
