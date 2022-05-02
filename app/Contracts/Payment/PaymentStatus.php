<?php

namespace App\Contracts\Payment;

/**
 * @method static PaymentStatus PENDING()
 * @method static PaymentStatus AUTHORIZED()
 * @method static PaymentStatus ON_HOLD()
 * @method static PaymentStatus PAID()
 * @method static PaymentStatus PARTIALLY_PAID()
 * @method static PaymentStatus DECLINED()
 * @method static PaymentStatus TIMEOUT()
 * @method static PaymentStatus CANCELLED()
 * @method static PaymentStatus REFUNDED()
 */
interface PaymentStatus
{
    /** @return string */
    public function value(): string;

    /** @return string */
    public function label(): string;
}
