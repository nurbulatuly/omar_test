<?php

namespace App\Contracts\Property;

use Illuminate\Support\Collection;

interface Property
{
    public function getType(): PropertyType;

    public function values(): Collection;

    public static function findBySlug(string $slug): ?Property;
}
