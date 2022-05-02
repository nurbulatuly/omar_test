<?php

namespace App\Foundation\PropertyTypes;

use App\Contracts\Property\PropertyType;

class Boolean implements PropertyType
{
    private const FALSE_VALUES = ['false', '0', '', 'null', 'no'];

    public function getName(): string
    {
        return __('Boolean');
    }

    public function transformValue(string $value, ?array $settings): bool
    {
        return !in_array(strtolower($value), static::FALSE_VALUES);
    }
}
