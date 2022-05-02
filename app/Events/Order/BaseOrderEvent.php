<?php

namespace App\Events\Order;

use App\Contracts\Order\Order;
use App\Contracts\Order\OrderAwareEvent;

abstract class BaseOrderEvent implements OrderAwareEvent
{
    use HasOrder;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
