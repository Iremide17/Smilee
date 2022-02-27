<?php

namespace App\Listeners;

use App\Events\OrderWasCreated;
use App\Notifications\NewOrderNotification;

class SendNewOrderNotification
{
    public function handle(OrderWasCreated $event)
    {
        $vendor = $event->detail->vendor;
        $vendor->user()->notify(new  NewOrderNotification($event->detail));

    }
}
