<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $number
 * @property string $notes
 * @property OrderStatus $status
 * @property null|int $billpayer_id
 * @property null|Billpayer $billpayer
 * @property null|int $user_id
 * @property null|User $user
 * @property null|Address $shippingAddress
 * @property null|int $shipping_address_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property null|Carbon $deleted_at
 * @property OrderItem[]|Collection $items
 * @method static Order create(array $attributes = [])
 * @method static Builder open()
 */
class Order extends Model
{
    use HasFactory, CastsEnums;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $enums = [
        'status' => 'OrderStatusProxy@enumClass'
    ];

    public function __construct(array $attributes = [])
    {
        // Set default status in case there was none given
        if (!isset($attributes['status'])) {
            $this->setDefaultOrderStatus();
        }

        parent::__construct($attributes);
    }

    public static function findByNumber(string $orderNumber): ?OrderContract
    {
        return static::where('number', $orderNumber)->first();
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }

    public function getBillpayer(): ?BillPayer
    {
        return $this->billpayer;
    }

    public function getShippingAddress(): ?Address
    {
        return $this->shippingAddress;
    }

    public function getItems(): Traversable
    {
        return $this->items;
    }

    public function billpayer()
    {
        return $this->belongsTo(BillpayerProxy::modelClass());
    }

    public function shippingAddress()
    {
        return $this->belongsTo(AddressProxy::modelClass());
    }

    public function items()
    {
        return $this->hasMany(OrderItemProxy::modelClass());
    }

    public function total()
    {
        return $this->items->sum('total');
    }

    public function scopeOpen(Builder $query)
    {
        return $query->whereIn('status', OrderStatusProxy::getOpenStatuses());
    }

    protected function setDefaultOrderStatus()
    {
        $this->setRawAttributes(
            array_merge(
                $this->attributes,
                [
                    'status' => OrderStatusProxy::defaultValue()
                ]
            ),
            true
        );
    }
}
