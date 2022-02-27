<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

class VendorPolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SUBSCRIBE = 'subscribe';
    const UNSUBSCRIBE = 'unsubscribe';

    public function update(User $user, Vendor $vendor): bool
    {
        return $vendor->isAuthoredBy($user) || $user->isAdmin();
    }

    public function delete(User $user, Vendor $vendor): bool
    {
        return $vendor->isAuthoredBy($user) || $user->isAdmin();
    }

    public function subscribe(User $user, Vendor $vendor): bool
    {
        return !$vendor->hasSubscriber($user);
    }

    public function unsubscribe(User $user, Vendor $vendor): bool
    {
        return $vendor->hasSubscriber($user);
    }
}
