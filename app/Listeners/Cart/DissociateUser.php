<?php

namespace App\Listeners\Cart;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DissociateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        if (config('vanilo.cart.auto_assign_user') && !config('vanilo.cart.preserve_for_user')) {
            if (null !== Cart::getUser()) { // Prevent from surplus db operations
                Cart::removeUser();
            }
        }
    }
}
