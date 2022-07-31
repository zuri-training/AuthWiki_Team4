<?php

namespace App\Policies;

use App\Models\{
    User,
    Wiki
};
use Illuminate\{
    Auth\Access\HandlesAuthorization,
    Support\Facades\Auth
};

class WikiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Wiki $wiki)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Wiki $wiki)
    {
        return $user->id == $wiki->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Wiki $wiki)
    {
        return $user->id == $wiki->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Wiki $wiki)
    {
        return $user->id == $wiki->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Wiki  $wiki
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Wiki $wiki)
    {
        return $user->admin;
    }
}
