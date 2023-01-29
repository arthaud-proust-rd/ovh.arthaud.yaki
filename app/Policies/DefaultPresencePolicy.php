<?php

namespace App\Policies;

use App\Models\DefaultPresence;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DefaultPresencePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DefaultPresence $defaultPresence): bool
    {
        return $defaultPresence->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DefaultPresence $defaultPresence): bool
    {
        return $defaultPresence->user_id === $user->id;

    }

    public function delete(User $user, DefaultPresence $defaultPresence): bool
    {
        return $defaultPresence->user_id === $user->id;

    }

    public function restore(User $user, DefaultPresence $defaultPresence): bool
    {
        return $defaultPresence->user_id === $user->id;
    }

    public function forceDelete(User $user, DefaultPresence $defaultPresence): bool
    {
        return $defaultPresence->user_id === $user->id;
    }
}
