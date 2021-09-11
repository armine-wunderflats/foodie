<?php

namespace App\Policies;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MealPolicy
{
    use HandlesAuthorization;
        
    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if($user->is_admin) return true;
    }

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
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Meal $meal)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Meal $meal)
    {
        return $user->id == $meal->restaurant->owner->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Meal $meal)
    {
        return $user->id == $meal->restaurant->owner->id;
    }
}
