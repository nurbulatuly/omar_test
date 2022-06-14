<?php

namespace App\Contracts\Product;

use Illuminate\Database\Eloquent\Model;

interface MasterProduct
{
    public function createVariant(array $data) : Model;
}
