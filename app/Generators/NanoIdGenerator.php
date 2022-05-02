<?php

namespace App\Generators;

use App\Contracts\Order\Order;
use App\Contracts\Order\OrderNumberGenerator;
use App\Foundation\Generators\NanoIdGenerator as BaseNanoIdGenerator;

final class NanoIdGenerator extends BaseNanoIdGenerator implements OrderNumberGenerator
{
    private const ALPHABET = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private $alphabet;

    private $size = 12;

    public function __construct(int $size = null, string $alphabet = null)
    {
        parent::__construct(
            $size ?? $this->config('size', $this->size),
            $alphabet ?? $this->config('alphabet', self::ALPHABET)
        );
    }

    public function generateNumber(Order $order = null): string
    {
        return parent::generate();
    }

    private function config(string $key, $default = null)
    {
        return config('shop.order.number.nano_id.' . $key, $default);
    }
}
