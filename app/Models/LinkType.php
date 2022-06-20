<?php

namespace App\Models;

use App\Contracts\Links\LinkType as LinkTypeContract;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LinkType extends Model implements LinkTypeContract
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers {
        findBySlug as protected sluggableFindBySlug;
    }

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function findBySlug(string $slug): ?LinkTypeContract
    {
        return static::sluggableFindBySlug($slug);
    }

    public static function choices(bool|array $withInactives = false, bool $slugAsKey = false): array
    {
        if (false === $withInactives || empty($withInactives)) {
            $query = static::active();
        } elseif (true === $withInactives) {
            $query = static::query();
        } else {
            $lookupField = (is_int($withInactives[0] ?? null)) ? 'id' : 'slug';
            $query = static::active()->orWhereIn($lookupField, $withInactives);
        }

        $keyField = $slugAsKey ? 'slug' : 'id';

        return $query->get([$keyField, 'name'])->pluck('name', $keyField)->all();
    }

    public function scopeBySlug(Builder $builder, string $slug): Builder
    {
        return $this->scopeWhereSlug($builder, $slug);
    }

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', true);
    }

    public function scopeInactive(Builder $builder): Builder
    {
        return $builder->where('is_active', false);
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
