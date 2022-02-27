<?php

namespace App\Listeners;

use App\Events\ProductWasCreated;
use App\Notifications\NewProductNotification;

class sendNewProductNotification
{
    public function handle(ProductWasCreated $event)
    {
        $product = $event->product->vendor;

        foreach ($product->subscriptions() as $subscription) {
            $subscription->user()->notify(new NewProductNotification($event->product));
        }
    }
}
