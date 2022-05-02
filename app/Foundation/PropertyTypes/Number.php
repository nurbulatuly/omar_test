<?php

namespace App\Foundation\PropertyTypes;

use App\Contracts\Property\PropertyType;

class Number implements PropertyType
{
    public function getName(): string
    {
        return __('Number');
    }

    public function transformValue(string $value, ?array $settings): float
    {
        return (float) $value;
    }
}
