<?php

namespace App\Models;

use App\Contracts\Order\OrderItem as OrderItemContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order as OrderProxy;

class OrderItem extends Model implements OrderItemContract
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo(OrderProxy::class);
    }

    public function product()
    {
        return $this->morphTo();
    }

    public function total()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Property accessor alias to the total() method
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->total();
    }
}
