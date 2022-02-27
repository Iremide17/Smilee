<?php

namespace App\Listeners;

use App\Events\BookingWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardPointsForBooking implements ShouldQueue
{
    public function handle(BookingWasCreated $event)
    {
        $amount = config('points.rewards.new_booking');
        $message = 'You booked a property';

        $author = $event->booking->author();

        $author->addPoints($amount, $message);
    }
}
