<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
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
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Offer $offer)
    {
        return $user->id === $offer->company->owner->id ||
            $user->city->id === $offer->company->city_id ||
            $user->hasRole(['admin']);
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
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Offer $offer)
    {
        return $user->id === $offer->company->owner->id || $user->hasRole(['admin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Offer $offer)
    {
        return $user->id == $offer->company->owner->id || $user->hasRole(['admin']);
    }
}
