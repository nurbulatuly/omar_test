<?php

namespace App\Foundation\Links\Query;

use App\Models\Property;

trait HasPropertyFilter
{
    private static string $propertyProxyClass = Property::class;

    private static ?string $propertiesModelClass = null;

    private null|int|string $property = null;

    public static function usePropertiesModel(string $class): void
    {
        self::$propertiesModelClass = $class;
    }

    public function basedOn(int|string $property): self
    {
        $this->property = $property;

        return $this;
    }

    private function propertyId(): ?int
    {
        return match (true) {
            is_null($this->property) => null,
            is_int($this->property) => $this->property,
            is_string($this->property) => $this->fetchProperty()?->id,
            default => null,
        };
    }

    private function hasPropertyFilter(): bool
    {
        return null !== $this->property;
    }

    private function fetchProperty(): ?object
    {
        $propertiesClass = null !== self::$propertiesModelClass ? self::$propertiesModelClass : self::$propertyProxyClass;

        return $propertiesClass::findBySlug($this->property);
    }
}
