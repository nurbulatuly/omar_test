<?php

namespace App\Foundation\PropertyTypes;

use App\Contracts\Property\PropertyType;

class Integer implements PropertyType
{
    public function getName(): string
    {
        return __('Integer');
    }

    public function transformValue(string $value, ?array $settings): int
    {
        return (int) $value;
    }
}
