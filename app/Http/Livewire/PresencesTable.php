<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\CarbonImmutable;
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
}
