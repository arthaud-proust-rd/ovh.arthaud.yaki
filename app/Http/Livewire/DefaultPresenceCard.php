<?php

namespace App\Http\Livewire;

use App\Models\DefaultPresence;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DefaultPresenceCard extends Component
{
    public User $user;
    public DefaultPresence $defaultPresence;
    public int $dayOfWeek;

    public function mount(User $user, DefaultPresence $defaultPresence): void
    {
        $this->user = $user;
        $this->defaultPresence = $defaultPresence;
        $this->dayOfWeek = $defaultPresence->day_of_week;
    }

    public function render(): View
    {
        return view('livewire.presence-card', [
            'presence' => $this->defaultPresence
        ]);
    }

    public function toggleEatMidday(): void
    {
        if (!$this->defaultPresence->exists) {
            $this->createDefaultPresence();
            return;
        }

        Gate::authorize('update', $this->defaultPresence);

        $this->defaultPresence->update([
            'eat_midday_at_home' => !$this->defaultPresence->eat_midday_at_home
        ]);
    }

    public function createDefaultPresence(): void
    {
        $this->defaultPresence->user_id = $this->user->id;
        $this->defaultPresence->day_of_week = $this->dayOfWeek;

        $this->defaultPresence->save();
    }

    public function toggleEatEvening(): void
    {
        if (!$this->defaultPresence->exists) {
            $this->createDefaultPresence();
            return;
        }

        Gate::authorize('update', $this->defaultPresence);

        $this->defaultPresence->update([
            'eat_evening_at_home' => !$this->defaultPresence->eat_evening_at_home
        ]);
    }

    public function toggleAll(): void
    {
        if (!$this->defaultPresence->exists) {
            $this->createDefaultPresence();
            return;
        }

        Gate::authorize('update', $this->defaultPresence);

        $this->defaultPresence->update([
            'eat_midday_at_home' => !$this->defaultPresence->eat_midday_at_home,
            'eat_evening_at_home' => !$this->defaultPresence->eat_evening_at_home,
            'sleep_at_home' => !$this->defaultPresence->sleep_at_home
        ]);
    }

    public function toggleSleep(): void
    {
        if (!$this->defaultPresence->exists) {
            $this->createDefaultPresence();
            return;
        }

        Gate::authorize('update', $this->defaultPresence);

        $this->defaultPresence->update([
            'sleep_at_home' => !$this->defaultPresence->sleep_at_home
        ]);
    }
}
