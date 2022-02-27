<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    const DELETE = 'delete';
    CONST ACCEPT = 'accept';
    CONST REJECT = 'reject';
    CONST VERIFY = 'verify';
    CONST ACTION = 'action';


    public function delete(User $user, Booking $booking): bool
    {
        return $booking->isAuthoredBy($user) || $user->isAdmin();
    }

    public function accept(User $user, Booking $booking): bool
    {
        return $booking->isAuthoredBy($user) || $user->isAdmin();
    }

    public function reject(User $user, Booking $booking): bool
    {
        return $booking->isAuthoredBy($user) || $user->isAdmin();
    }

    public function verify(User $user, Booking $booking): bool
    {
        return $booking->isAuthoredBy($user) && $booking->payable();
    }

    public function action(User $user, Booking $booking): bool
    {
        return $booking->agent->isUseredBy($user);
    }

}
