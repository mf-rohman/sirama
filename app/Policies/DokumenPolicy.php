<?php

namespace App\Policies;

use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DokumenPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if($user->isAdmin()) {
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isVerificator() || $user->isDosen();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dokumen $dokumen): bool
    {
        return $user->isVerificator() || $dokumen->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isDosen();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dokumen $dokumen): bool
    {
        if ($user->isVerificator()) {
            return true;
        }
        return $dokumen->user_id === $user->id && $dokumen->status === 'diunggah';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dokumen $dokumen): bool
    {
        return $dokumen->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Dokumen $dokumen): bool
    // {

    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Dokumen $dokumen): bool
    // {
    //     //
    // }
}
