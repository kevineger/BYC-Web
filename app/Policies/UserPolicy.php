<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param $profile_user
     * @return bool
     */
    public function updateUser(User $user, $profile_user)
    {
        return ($user == $profile_user) || $user->admin;
    }
}
