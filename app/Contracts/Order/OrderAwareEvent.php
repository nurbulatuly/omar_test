<?php

namespace App\Contracts\Order;

interface OrderAwareEvent
{
    public function getOrder(): Order;
}
