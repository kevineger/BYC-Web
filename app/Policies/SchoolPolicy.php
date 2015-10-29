<?php

namespace App\Policies;

use App\School;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy {

    use HandlesAuthorization;

    public function update(User $user, School $school)
    {
        return $user->owns($school);
    }
}
