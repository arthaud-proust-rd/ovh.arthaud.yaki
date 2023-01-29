<section class="px-2 py-4 relative">
    <div class="h-28 grid grid-rows-3 gap-1">
        @if(!$presence->exists)
            <span class="row-start-1 row-end-4 presence-ceil @can('update', $presence) unfilled @endif"></span>
        @elseif($presence->is_totally_absent)
            <span class="row-start-1 row-end-4 presence-ceil absent">Absent</span>
        @elseif($presence->is_totally_present)
            <span class="row-start-1 row-end-4 presence-ceil present">Présent</span>
        @else
            @if($presence->eat_midday_at_home)
                <span class="row-start-1 row-end-2 presence-ceil present">Déjeune</span>
            @else
                <span
                    class="row-start-1 row-end-2 presence-ceil absent">Absent</span>
            @endif

            @if($presence->eat_evening_at_home)
                <span class="row-start-2 row-end-3 presence-ceil present">Dîne</span>
            @else
                <span
                    class="row-start-2 row-end-3 presence-ceil absent">Absent</span>
            @endif

            @if($presence->sleep_at_home)
                <span class="row-start-3 row-end-4 presence-ceil present">Dors</span>
            @else
                <span
                    class="row-start-3 row-end-4 presence-ceil absent">Absent</span>
            @endif
        @endif
    </div>
    @can('update', $presence)
        <div class="px-2 py-4 absolute inset-0 grid grid-rows-3 grid-cols-presence-action gap-1">
            <button wire:click="toggleAll()" class="presence-ceil row-span-3 col-span-1 button">
                <x-heroicon-o-arrow-path class="icon"/>
            </button>
            <button wire:click="toggleEatMidday()" class="presence-ceil col-span-1 button">
                @if($presence->eat_midday_at_home)
                    Absent
                @else
                    Déjeune
                @endif
            </button>
            <button wire:click="toggleEatEvening()" class="presence-ceil col-span-1 button">
                @if($presence->eat_evening_at_home)
                    Absent
                @else
                    Dîne
                @endif
            </button>
            <button wire:click="toggleSleep()" class="presence-ceil col-span-1 button">
                @if($presence->sleep_at_home)
                    Absent
                @else
                    Dors
                @endif
            </button>
        </div>
    @endif
</section>
