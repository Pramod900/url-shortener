<?php

namespace App\Policies;

use App\Models\User;

class ShortLinkPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return in_array($user->role, ['admin', 'superadmin']);
    }

    public function create(User $user) {
        return $user->role !== 'superadmin';
    }
}
