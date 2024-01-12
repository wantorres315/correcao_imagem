<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestimonialsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $view = false;
        if($user->hasRole('Editor') || $user->hasRole('Admin')){
            $view = true;
        }
        return $view;
    }

    
}
