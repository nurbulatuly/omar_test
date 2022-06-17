<?php

namespace App\Models;

use App\Contracts\Product\MasterProduct;
use App\Contracts\Product\MasterProductVariant;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements MasterProduct
{
    use Sluggable;
    use SluggableScopeHelpers;
    use HasFactory;

    protected $fillable = ['title','foreign_uid'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function taxon() : BelongsTo
    {
        return $this->belongsTo(Taxon::class);
    }

    public function variants() : HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function createVariant(array $data) : Model
    {
        return $this->variants()->create($data);
    }
}
