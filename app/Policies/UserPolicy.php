<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    const SUPERADMIN = 'superAdmin';
    const ADMIN = 'admin';
    const BAN = 'ban';
    const DELETE = 'delete';
    const ADMINROUTE = 'adminRoute';
    const WRITERROUTE = 'writerRoute';
    const AGENTROUTE = 'agentRoute';
    const VENDORROUTE = 'vendorRoute';
    const DEFAULT = 'default';


    public function superAdmin(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function adminRoute(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function writerRoute(User $user): bool
    {
        return $user->isWriter() || $user->isAdmin() || $user->isSuperAdmin();
    }

    public function agentRoute(User $user): bool
    {
        return $user->isAgent() || $user->isAdmin() || $user->isSuperAdmin();
    }

    public function vendorRoute(User $user): bool
    {
        return $user->isVendor() || $user->isAdmin() || $user->isSuperAdmin();
    }

    public function admin(User $user): bool
    {
        return $user->isAdmin() || $user->isSuperAdmin();
    }

    public function ban(User $user, User $subject): bool
    {
        return ($user->isAdmin() && !$subject->isAdmin()) ||
            ($user->isModerator() && !$subject->isAdmin() && !$subject->isModerator());
    }

    public function delete(User $user, User $subject)
    {
        return ($user->isAdmin() || $user->matches($subject)) && !$subject->isAdmin();
    }

    public function default(User $user): bool
    {
        return $user->isDefault();
    }
}
