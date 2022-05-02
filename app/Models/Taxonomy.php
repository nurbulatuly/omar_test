<?php

namespace App\Models;

use App\Contracts\Categorization\Taxonomy as TaxonomyContract;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Taxonomy extends Model implements TaxonomyContract
{
    use HasFactory;

    use Sluggable;
    use SluggableScopeHelpers;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function findOneByName(string $name): ?TaxonomyContract
    {
        return static::where('name', $name)->first();
    }

    public static function findOneBySlug(string $slug, array $columns = ['*']): ?TaxonomyContract
    {
        return static::findBySlug($slug, $columns);
    }

    public function taxa(): HasMany
    {
        return $this->hasMany(Taxon::class, 'taxonomy_id', 'id');
    }

    public function taxons(): HasMany
    {
        return $this->taxa();
    }

    public function rootLevelTaxons(): Collection
    {
        return Taxon::byTaxonomy($this)
            ->roots()
            ->sort()
            ->get();
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
