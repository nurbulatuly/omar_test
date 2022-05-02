<?php

namespace App\Contracts\Property;

interface PropertyType
{
    public function getName(): string;

    public function transformValue(string $value, ?array $settings);
}
