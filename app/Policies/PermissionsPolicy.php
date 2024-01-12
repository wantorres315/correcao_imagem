<?php

namespace App\Policies;

use App\Models\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionsPolicy
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
}
