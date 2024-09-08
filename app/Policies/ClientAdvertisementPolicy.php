<?php

namespace App\Policies;

use App\Models\ClientAdvertisement;
use App\Models\User;

class ClientAdvertisementPolicy
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
        ClientAdvertisement $clientAdvertisement
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
        ClientAdvertisement $clientAdvertisement
    ): bool {
        return $user->id === $clientAdvertisement->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(
        User $user,
        ClientAdvertisement $clientAdvertisement
    ): bool {
        return $user->id === $clientAdvertisement->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(
        User $user,
        ClientAdvertisement $clientAdvertisement
    ): bool {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        ClientAdvertisement $clientAdvertisement
    ): bool {
        //
    }

}
