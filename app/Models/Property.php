<?php

namespace App\Models;

use App\Contracts\Property\Property as PropertyContract;
use App\Contracts\Property\PropertyType;
use App\Exceptions\UnknownPropertyTypeException;
use App\Foundation\PropertyTypes\PropertyTypes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Property extends Model implements PropertyContract
{
    use Sluggable, HasFactory;
    use SluggableScopeHelpers {
        findBySlug as protected sluggableFindBySlug;
    }

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'configuration' => 'array'
    ];

    public function getType(): PropertyType
    {
        $class = PropertyTypes::getClass($this->type);

        if (!$class) {
            throw new UnknownPropertyTypeException(
                sprintf('Unknown property type `%s`', $this->type)
            );
        }

        return new $class();
    }

    public static function findBySlug(string $slug): ?PropertyContract
    {
        return static::sluggableFindBySlug($slug);
    }

    public static function findOneByName(string $name): ?PropertyContract
    {
        return Property::where('name', $name)->first();
    }

    public function values(): Collection
    {
        return $this->propertyValues()->sort()->get();
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
