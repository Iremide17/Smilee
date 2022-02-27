<?php

namespace App\Listeners;

use App\Events\BookingWasAccepted;
use App\Events\BookingWasVerified;
use Illuminate\Contracts\Queue\ShouldQueue;

class AwardPointsForAcceptingBooking implements ShouldQueue
{
    public function handle(BookingWasVerified $event)
    {
        $amount = config('points.rewards.new_booking_accepted');
        $message = 'You accepted a booking';

        $author = $event->booking->agent->author();

        $author->addPoints($amount, $message);
    }
}
