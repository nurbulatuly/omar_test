<?php

namespace App\Models;

use App\Contracts\Product\MasterProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model implements MasterProductVariant
{
    use HasFactory;

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
