<?php

namespace App\Events\Order;

use App\Contracts\Order\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

trait HasOrder
{
    /** @var  Order */
    protected $order;

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
