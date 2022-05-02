<?php

namespace App\Contracts\Order;

interface OrderStatus
{
    /**
     * Returns whether the status represents an open state
     *
     * @return boolean
     */
    public function isOpen(): bool;

    /**
     * Returns an array of statuses that represent an open order state
     *
     * @return array
     */
    public static function getOpenStatuses(): array;
}
