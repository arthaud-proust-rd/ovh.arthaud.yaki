<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PresenceResume extends Component
{
    public Carbon $day;

    protected $listeners = [
        'presenceUpdated' => 'render'
    ];

    public function render(): View
    {
        return view('livewire.presence-resume');
    }

    public function getEatCountProperty(): int
    {
        return Presence::where('date', $this->day)
            ->where('eat_at_home', true)
            ->count();
    }

    public function getSleepCountProperty(): int
    {
        return Presence::where('date', $this->day)
            ->where('sleep_at_home', true)
            ->count();
    }
}
