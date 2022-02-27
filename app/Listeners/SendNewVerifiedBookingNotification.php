<?php

namespace App\Listeners;

use App\Events\BookingWasVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewBookingVerifiedNotification;

class SendNewVerifiedBookingNotification implements ShouldQueue
{
    public function handle(BookingWasVerified $event)
    {
        $agent = $event->booking->property->agent;

        $agent->author()->notify(new NewBookingVerifiedNotification($event->booking));

    }
}
