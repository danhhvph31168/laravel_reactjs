<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
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

        $user = User::query()->find(1);
        $user->notify(new OrderNotification($order));
    }
}
