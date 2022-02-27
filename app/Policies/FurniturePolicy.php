<?php

namespace App\Policies;

use App\Models\Furniture;
use App\Models\User;

class FurniturePolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';

    public function update(User $user, Furniture $furniture): bool
    {
        return $furniture->isUseredBy($user) || $user->isAdmin();
    }

    public function delete(User $user, Furniture $furniture): bool
    {
        return $furniture->vendor->id() == $user->vendor->id() || $user->isAdmin();
    }
}