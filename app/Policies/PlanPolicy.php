<?php

namespace App\Policies;

use App\Plan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if($user->role === 'admin') {
            return true;
        }
    }

    public function show(User $user, Plan $plan)
    {
        if(
            ($user->role === 'coach' && $plan->user_id === $user->id)
            || ($user->role === 'gymnast' && $user->attachedPlans->has($plan->id))
        ) {
            return true;
        }

        return false;
    }

    public function create(User $user)
    {
        return $user->role === 'coach';
    }

    public function update(User $user, Plan $plan)
    {
        return $user->id === $plan->user_id;
    }
}
