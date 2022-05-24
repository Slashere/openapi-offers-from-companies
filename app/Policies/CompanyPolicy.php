<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Company $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Company $company)
    {
        return $user->id === $company->owner->id || $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasRole(['admin', 'company']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Company $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Company $company)
    {
        return $user->id === $company->owner->id || $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Company $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Company $company)
    {
        return $user->id == $company->owner->id || $user->hasRole(['admin']);
    }

}
