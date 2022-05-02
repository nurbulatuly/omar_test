<?php

namespace App\Foundation\PropertyTypes;

use App\Contracts\Property\PropertyType;

class Text implements PropertyType
{
    public function getName(): string
    {
        return __('Text');
    }

    public function transformValue(string $value, ?array $settings): string
    {
        return $value;
    }
}
