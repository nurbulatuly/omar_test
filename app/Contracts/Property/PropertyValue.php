<?php

namespace App\Contracts\Property;

interface PropertyValue
{
    /**
     * Returns the transformed value according to the underlying type
     */
    public function getCastedValue();
}
