<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DefaultWeekPresenceEdition extends Component
{
    public CarbonImmutable $firstDayOfWeek;

    public function mount(): void
    {
        $this->firstDayOfWeek = now()->toImmutable()->startOfWeek(Carbon::FRIDAY);
    }

    public function render(): View
    {
        return view('livewire.default-week-presence-edition', [
            'me' => auth()->user()
        ]);
    }

    public function getDaysOfWeekProperty(): CarbonPeriod
    {
        return CarbonPeriod::create($this->firstDayOfWeek->copy(), '1 day', 7);
    }
}
