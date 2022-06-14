<?php

namespace App\Models;

use App\Contracts\Product\MasterProductVariant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model implements MasterProductVariant
{
    use HasFactory;


}
