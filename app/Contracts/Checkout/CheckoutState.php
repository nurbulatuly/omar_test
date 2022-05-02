<?php

namespace App\Contracts\Checkout;

interface CheckoutState
{
    /**
     * Returns whether the state represents a state where the checkout can be submitted
     *
     * @return bool
     */
    public function canBeSubmitted();

    /**
     * Returns an array of states that represent an checkout state that is ready to be submitted
     *
     * @return array
     */
    public static function getSubmittableStates();
}
