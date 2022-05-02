<?php

namespace App\Models;

use App\Contracts\Order\OrderStatus as OrderStatusContract;
use Konekt\Enum\Enum;

class OrderStatus extends Enum implements OrderStatusContract
{
    public const __DEFAULT = self::PENDING;

    /**
     * Pending orders are brand new orders that have not been processed yet.
     */
    public const PENDING = 'pending';

    /**
     * Orders fulfilled completely.
     */
    public const COMPLETED = 'completed';

    /**
     * Order that has been cancelled.
     */
    public const CANCELLED = 'cancelled';

    // $labels static property needs to be defined
    public static array $labels = [];

    protected static array $openStatuses = [self::PENDING];

    public function isOpen(): bool
    {
        return in_array($this->value, static::$openStatuses);
    }

    public static function getOpenStatuses(): array
    {
        return static::$openStatuses;
    }

    protected static function boot()
    {
        static::$labels = [
            self::PENDING => __('Pending'),
            self::COMPLETED => __('Completed'),
            self::CANCELLED => __('Cancelled')
        ];
    }
}
