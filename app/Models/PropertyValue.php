<?php

namespace App\Models;

use App\Contracts\Property\PropertyValue as PropertyValueContract;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyValue extends Model implements PropertyValueContract
{
    use HasFactory;

    use Sluggable;
    use SluggableScopeHelpers;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'settings' => 'array'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('priority');
    }

    public function scopeSortReverse($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    public function scopeByProperty($query, $property)
    {
        $id = is_object($property) ? $property->id : $property;

        return $query->where('property_id', $id);
    }

    /**
     * Returns the transformed value according to the underlying type
     */
    public function getCastedValue()
    {
        return $this->property->getType()->transformValue((string) $this->value, $this->settings);
    }

    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        return $query->where('property_id', $model->property->id);
    }

    public function sluggable(): array
    {
        return [
            'value' => [
                'source' => 'title'
            ]
        ];
    }
}
