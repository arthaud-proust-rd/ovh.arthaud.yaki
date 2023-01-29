<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class PresenceCard extends Component
{
    public User $user;
    public Presence $presence;
    public Carbon $date;

    public function mount(User $user, Presence $presence): void
    {
        $this->user = $user;
        $this->presence = $presence;
        $this->date = $presence->date;
    }

    public function render(): View
    {
        return view('livewire.presence-card');
    }

    public function toggleEatMidday(): void
    {
        $this->updatePresenceResume();

        if (!$this->presence->exists) {
            $this->createPresence();
            return;
        }

        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'eat_midday_at_home' => !$this->presence->eat_midday_at_home
        ]);
    }

    public function updatePresenceResume(): void
    {
        $this->emit('presenceUpdated');
    }

    public function createPresence(): void
    {
        $this->presence->user_id = $this->user->id;
        $this->presence->date = $this->date;

        $this->presence->save();
    }

    public function toggleEatEvening(): void
    {
        $this->updatePresenceResume();

        if (!$this->presence->exists) {
            $this->createPresence();
            return;
        }

        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'eat_evening_at_home' => !$this->presence->eat_evening_at_home
        ]);
    }

    public function toggleAll(): void
    {
        $this->updatePresenceResume();

        if (!$this->presence->exists) {
            $this->createPresence();
            return;
        }

        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'eat_midday_at_home' => !$this->presence->eat_midday_at_home,
            'eat_evening_at_home' => !$this->presence->eat_evening_at_home,
            'sleep_at_home' => !$this->presence->sleep_at_home
        ]);
    }

    public function toggleSleep(): void
    {
        $this->updatePresenceResume();

        if (!$this->presence->exists) {
            $this->createPresence();
            return;
        }

        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'sleep_at_home' => !$this->presence->sleep_at_home
        ]);
    }
}
