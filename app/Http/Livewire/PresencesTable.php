<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
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
        $me = auth()->user();
        return view('livewire.presences-table', [
            'me' => $me,
            'otherUsers' => User::whereNot('id', $me->id)->get()
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
}
