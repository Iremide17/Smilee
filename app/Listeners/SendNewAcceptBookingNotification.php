<?php

namespace App\Listeners;

use App\Events\BookingWasAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewBookingAcceptedNotification;

class SendNewAcceptBookingNotification implements ShouldQueue
{
    public function handle(BookingWasAccepted $event)
    {
        $author = $event->booking->author();

        $author->notify(new NewBookingAcceptedNotification($event->booking));

    }
}
