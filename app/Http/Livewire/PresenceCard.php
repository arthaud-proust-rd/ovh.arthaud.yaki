<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use App\Models\User;
use Livewire\Component;

class PresenceCard extends Component
{
    public User $user;
    public Presence $presence;

    public function render()
    {
        return view('livewire.presence-card');
    }
}
