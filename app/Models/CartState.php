<?php

namespace App\Models;

use App\Contracts\Cart\CartState as CartStateContract;
use Konekt\Enum\Enum;

class CartState extends Enum implements CartStateContract
{
    public const __DEFAULT = self::ACTIVE;
    public const ACTIVE = 'active';
    public const CHECKOUT = 'checkout';
    public const COMPLETED = 'completed';
    public const ABANDONED = 'abandoned';

    protected static array $labels = [];

    protected static array $activeStates = [self::ACTIVE, self::CHECKOUT];

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return in_array($this->value, static::$activeStates);
    }

    /**
     * @inheritDoc
     */
    public static function getActiveStates(): array
    {
        return static::$activeStates;
    }

    protected static function boot()
    {
        static::$labels = [
            self::ACTIVE => __('Active'),
            self::CHECKOUT => __('Checkout'),
            self::COMPLETED => __('Completed'),
            self::ABANDONED => __('Abandoned')
        ];
    }
}
