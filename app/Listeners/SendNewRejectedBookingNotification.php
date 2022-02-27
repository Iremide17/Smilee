<?php

namespace App\Listeners;

use App\Events\BookingWasRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewBookingRejectedNotification;

class SendNewRejectedBookingNotification
{
    public function handle(BookingWasRejected $event)
    {
        $author = $event->booking->author();

        $author->notify(new NewBookingRejectedNotification($event->booking));

    }
}
