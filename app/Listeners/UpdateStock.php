<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Stock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateStock
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $stock = Stock::query()->where('product_name', $order->product_name)->first();
        if ($stock) {
            $stock->quantity -= $order->quantity;
            $stock->update(['quantity' => $stock->quantity]);
        }
    }
}
