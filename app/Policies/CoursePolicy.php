<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Course;
use App\User;

class CoursePolicy {

    use HandlesAuthorization;

    public function updateCourse(User $user, Course $course)
    {
        return $user->school->owns($course);
    }
}
