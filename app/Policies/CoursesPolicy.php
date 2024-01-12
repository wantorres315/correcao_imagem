<?php

namespace App\Policies;

use App\Models\Courses;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursesPolicy
{
    public function viewAny(User $user): bool
    {
        $view = false;
        if($user->hasRole('Super Admin')){
            $view = true;
        }
        return $view;
    }
}
