<?php

namespace App\Listeners\Cart;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignToUser
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
        if (config('vanilo.cart.auto_assign_user')) {
            if (Cart::getUser() && Cart::getUser()->id == $event->user->id) {
                return; // Don't associate to the same user again
            }
            Cart::setUser($event->user);
        }
    }
}
