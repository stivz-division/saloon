<?php

namespace App\Policies;

use App\Models\MasterAdvertisement;
use App\Models\User;

class MasterAdvertisementPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(
        User $user,
        MasterAdvertisement $masterAdvertisement
    ): bool {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(
        User $user,
        MasterAdvertisement $masterAdvertisement
    ): bool {
        return $user->id === $masterAdvertisement->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(
        User $user,
        MasterAdvertisement $masterAdvertisement
    ): bool {
        return $user->id === $masterAdvertisement->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(
        User $user,
        MasterAdvertisement $masterAdvertisement
    ): bool {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        MasterAdvertisement $masterAdvertisement
    ): bool {
        //
    }

}
