<?php

namespace App\Policies;

use App\Models\CoursesCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursesCategoryPolicy
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
