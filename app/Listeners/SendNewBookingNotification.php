<?php

namespace App\Listeners;

use App\Events\BookingWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewBookingNotification;

class SendNewBookingNotification implements ShouldQueue
{
    public function handle(BookingWasCreated $event)
    {
        $agent = $event->booking->property->agent;

        $agent->user()->notify(new NewBookingNotification($event->booking));

    }
}
