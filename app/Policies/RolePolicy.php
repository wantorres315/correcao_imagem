<?php

namespace App\Policies;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $view = false;
        if($user->hasRole('Super Admin')){
            $view = true;
        }
        return $view;
    }

    /**
     * Determine whether the user can view the model.
     */
    
}
