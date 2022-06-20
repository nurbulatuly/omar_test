<?php

namespace App\Models;

use App\Contracts\Product\MasterProductVariant;
use App\Traits\HasPropertyValues;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model implements MasterProductVariant
{
    use HasFactory;
    use HasPropertyValues;

    public function masterProduct() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function hasOwnName(): bool
    {
        return null !== $this->getRawOriginal('name');
    }

    public function hasOwnPrice(): bool
    {
        return null !== $this->getRawOriginal('price');
    }

    public function hasOwnOriginalPrice(): bool
    {
        return null !== $this->getRawOriginal('original_price');
    }

    public function hasOwnExcerpt(): bool
    {
        return null !== $this->getRawOriginal('excerpt');
    }

    public function hasOwnHeight(): bool
    {
        return null !== $this->getRawOriginal('height');
    }

    public function hasOwnWidth(): bool
    {
        return null !== $this->getRawOriginal('width');
    }

    public function hasOwnLength(): bool
    {
        return null !== $this->getRawOriginal('length');
    }

    public function hasOwnWeight(): bool
    {
        return null !== $this->getRawOriginal('weight');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->name : $value,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->price : $value,
        );
    }

    protected function originalPrice(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->original_price : $value,
        );
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->excerpt : $value,
        );
    }

    protected function height(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->height : $value,
        );
    }

    protected function width(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->width : $value,
        );
    }

    protected function length(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->length : $value,
        );
    }

    protected function weight(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? $this->masterProduct?->weight : $value,
        );
    }
}
