<?php

namespace App\Policies\Bbs;

use App\Models\Bbs\User;

class UserPolicy extends Policy
{

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
