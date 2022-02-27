<?php

namespace App\Listeners;

use App\Events\OrderWasChannelled;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardPointsForMakingOrder implements ShouldQueue
{
    public function handle(OrderWasChannelled $event)
    {
        $amount = config('points.rewards.new_order');
        $message = 'You have been awarded 5 points for making a new order';

        $user = $event->order->author();

        $user->addPoints($amount, $message);
    }
}
