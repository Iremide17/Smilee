<?php

namespace App\Events;

use App\Models\Booking;
use Illuminate\Queue\SerializesModels;

class BookingWasCreated
{
    use SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}
