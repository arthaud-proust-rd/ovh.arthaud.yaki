<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class PresenceCard extends Component
{
    public User $user;
    public Presence $presence;

    public function render(): View
    {
        return view('livewire.presence-card');
    }

    public function toggleEat(): void
    {
        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'eat_at_home' => !$this->presence->eat_at_home
        ]);
    }

    public function toggleSleep(): void
    {
        Gate::authorize('update', $this->presence);

        $this->presence->update([
            'sleep_at_home' => !$this->presence->sleep_at_home
        ]);
    }
}
