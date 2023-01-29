<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class PresencesTable extends Component
{
    public CarbonImmutable $firstDayOfWeek;

    public function mount(): void
    {
        $this->firstDayOfWeek = now()->toImmutable()->startOfWeek(Carbon::FRIDAY);
    }

    public function render(): View
    {
        $me = auth()->user();

        $dayCounts = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $this->firstDayOfWeek->addDays($i)->toDateString();

            $eatMidday = Presence::where('date', $date)
                ->where('eat_midday_at_home', true)
                ->count();

            $eatEvening = Presence::where('date', $date)
                ->where('eat_evening_at_home', true)
                ->count();

            $sleep = Presence::where('date', $date)
                ->where('sleep_at_home', true)
                ->count();

            $dayCounts[] = [
                'eat_midday' => $eatMidday,
                'eat_evening' => $eatEvening,
                'sleep' => $sleep
            ];
        }

        return view('livewire.presences-table', [
            'me' => $me,
            'otherUsers' => User::whereNot('id', $me->id)->get(),
            'dayCounts' => $dayCounts,
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

    public function fillWithDefaultWeek(): void
    {
        $me = auth()->user();
        foreach ($me->presencesOfWeek($this->daysOfWeek) as $presence) {
            $defaultPresence = $me->defaultPresences()->firstWhere('day_of_week', $presence->date->dayOfWeek);

            if (!$defaultPresence) {
                continue;
            }

            if (!$presence->exists) {
                $presence->user_id = $me->id;
                $presence->eat_midday_at_home = $defaultPresence->eat_midday_at_home;
                $presence->eat_evening_at_home = $defaultPresence->eat_evening_at_home;
                $presence->sleep_at_home = $defaultPresence->sleep_at_home;
                $presence->save();
            } else {
                $presence->update([
                    'eat_midday_at_home' => $defaultPresence->eat_midday_at_home,
                    'eat_evening_at_home' => $defaultPresence->eat_evening_at_home,
                    'sleep_at_home' => $defaultPresence->sleep_at_home
                ]);
            }
        }

    }

    public function clearWeek(): void
    {
        $me = auth()->user();
        foreach ($me->presencesOfWeek($this->daysOfWeek) as $presence) {
            $presence->delete();
        }
    }

    public function getDaysOfWeekProperty(): CarbonPeriod
    {
        return CarbonPeriod::create($this->firstDayOfWeek->copy(), '1 day', 7);
    }

    public function getLastDayOfWeekProperty(): CarbonImmutable
    {
        return $this->firstDayOfWeek->addDays(6);
    }
}
