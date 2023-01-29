<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PresencesTable extends Component
{
    public CarbonImmutable $firstDayOfWeek;

    public function mount(): void
    {
        $this->firstDayOfWeek = now()->toImmutable()->startOfWeek();
    }

    public function render(): View
    {
        return view('livewire.presences-table', [
            'me' => auth()->user(),
            'otherUsers' => User::all()
        ]);
    }

    public function nextWeek(): void
    {
        $this->firstDayOfWeek = $this->firstDayOfWeek->addWeek();
    }

    public function previousWeek(): void
    {
        $this->firstDayOfWeek = $this->firstDayOfWeek->subWeek();
    }

    public function getDaysOfWeekProperty(): CarbonPeriod
    {
        return CarbonPeriod::create($this->firstDayOfWeek->copy(), '1 day', 7);
    }

    public function getDaysCountProperty(): array
    {
        $t = [];
        foreach ($this->daysOfWeek as $day) {
            $t[] = [
                'eat' => User::whereHas('presences', static fn(Builder $query) => $query->where('eat_at_home', true)->where('date', $day->toDateString()))->count(),
                'sleep' => User::whereHas('presences', static fn(Builder $query) => $query->where('sleep_at_home', true)->where('date', $day->toDateString()))->count()
            ];
        }
        return $t;
    }
}
