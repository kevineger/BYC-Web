<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\School;
use App\User;

class SchoolPolicy {

    use HandlesAuthorization;

    public function update(User $user, School $school)
    {
        return $user->vendor && $user->owns($school);
    }
}
