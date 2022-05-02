<?php

namespace App\Contracts\Order;

interface Order
{
    public function getNumber(): ?string;

    public function getStatus(): OrderStatus;

    public function getBillpayer(): ?BillPayer;

    public function getShippingAddress(): ?Address;

    public function getItems(): Traversable;

    /**
     * Returns the final total of the Order
     *
     * @return float
     */
    public function total();
}
