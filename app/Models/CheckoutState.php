<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Konekt\Enum\Enum;
use App\Contracts\Checkout\CheckoutState as CheckoutStateContract;

class CheckoutState extends Enum implements CheckoutStateContract
{
    public const __DEFAULT = self::VIRGIN;

    public const VIRGIN = null;        // There was no interaction with the checkout process yet
    public const STARTED = 'started';   // The checkout process has been started
    public const READY = 'ready';     // Checkout data is valid and ready to submit
    public const COMPLETED = 'completed'; // Checkout has been completed

    protected static $submittableStates = [self::READY];

    /**
     * @inheritdoc
     */
    public function canBeSubmitted()
    {
        return in_array($this->value, static::$submittableStates);
    }

    /**
     * @inheritdoc
     */
    public static function getSubmittableStates()
    {
        return static::$submittableStates;
    }
}
