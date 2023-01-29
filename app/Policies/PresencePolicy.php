<?php

namespace App\Policies;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PresencePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Presence $presence): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Presence $presence): bool
    {
        return $user->id === $presence->user_id;
    }

    public function delete(User $user, Presence $presence): bool
    {
        return $user->id === $presence->user_id;
    }

    public function restore(User $user, Presence $presence): bool
    {
        return $user->id === $presence->user_id;
    }

    public function forceDelete(User $user, Presence $presence): bool
    {
        return $user->id === $presence->user_id;
    }
}
