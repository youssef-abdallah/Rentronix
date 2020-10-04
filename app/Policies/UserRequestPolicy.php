<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRequest  $userRequest
     * @return mixed
     */
    public function view(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRequest  $userRequest
     * @return mixed
     */
    public function update(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRequest  $userRequest
     * @return mixed
     */
    public function delete(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRequest  $userRequest
     * @return mixed
     */
    public function restore(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRequest  $userRequest
     * @return mixed
     */
    public function forceDelete(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }

    public function approve(User $user, UserRequest $userRequest)
    {
        return $user->hasRole('Admin');
    }
}
