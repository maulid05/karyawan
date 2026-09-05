<?php

namespace App\Policies;

use App\Models\RiwayatPekerjaan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RiwayatPekerjaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RiwayatPekerjaan $riwayatPekerjaan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RiwayatPekerjaan $riwayatPekerjaan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RiwayatPekerjaan $riwayatPekerjaan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RiwayatPekerjaan $riwayatPekerjaan): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RiwayatPekerjaan $riwayatPekerjaan): bool
    {
        return false;
    }
}
