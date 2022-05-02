<?php

namespace App\Models;

use App\Contracts\Cart\CartItem as CartItemContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model implements CartItemContract
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->morphTo();
    }
}
