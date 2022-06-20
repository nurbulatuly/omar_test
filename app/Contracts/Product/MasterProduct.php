<?php

namespace App\Contracts\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface MasterProduct
{
    public function variants(): HasMany;

    public function createVariant(array $data) : Model;
}
