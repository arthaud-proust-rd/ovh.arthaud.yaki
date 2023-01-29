<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PresenceResume extends Component
{
    public Carbon $day;

    public $listeners = [
        'presenceUpdated' => 'render'
    ];

    public function render(): View
    {
        return view('livewire.presence-resume');
    }

    public function getEatCountProperty(): int
    {
        return User::whereHas('presences',
            fn(Builder $query) => $query->where('eat_at_home', true)->where('date', $this->day->toDateString())
        )->count();
    }

    public function getSleepCountProperty(): int
    {
        return User::whereHas('presences',
            fn(Builder $query) => $query->where('sleep_at_home', true)->where('date', $this->day->toDateString())
        )->count();
    }

}
