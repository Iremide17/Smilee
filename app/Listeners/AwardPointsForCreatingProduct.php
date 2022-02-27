<?php

namespace App\Listeners;

use App\Events\ProductWasCreated;

class AwardPointsForCreatingProduct
{
    public function handle(ProductWasCreated $event)
    {
        $amount = config('points.rewards.new_product');
        $message = 'You created a new product';

        $vendor = $event->product->vendor->author();

        $vendor->addPoints($amount, $message);
    }
}
