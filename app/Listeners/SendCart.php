<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CartProcessed;
use App\Models\Cart;

class SendCart
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
    public function handle(CartProcessed $event)
    {
        $arr = $event->arr;
        $cart = Cart::find($arr->id);
        $cart->creator_id = 2;
        $cart->save();
    }
}
