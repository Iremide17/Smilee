<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\OrderDetail;

class OrderPolicy
{
    use HandlesAuthorization;

    CONST ACTION = 'action';
    CONST ACCEPT = 'accept';

    public function accept(User $user, OrderDetail $order): bool
    {
        return $order->isAuthoredBy($user) || $user->isAdmin();
    }
    
}
