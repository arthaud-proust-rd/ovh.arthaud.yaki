<section class="px-2 py-4 relative">
    <div class="h-16 grid grid-rows-2 gap-1">
        @if(!$presence->exists)
            <span class="row-start-1 row-end-3 presence-ceil @can('update', $presence) unfilled @endif"></span>
        @elseif(!$presence->eat_at_home && !$presence->sleep_at_home)
            <span class="row-start-1 row-end-3 presence-ceil absent">Absent</span>
        @elseif($presence->eat_at_home && $presence->sleep_at_home)
            <span class="row-start-1 row-end-3 presence-ceil present">Présent</span>
        @else
            @if($presence->eat_at_home)
                <span class="row-start-1 row-end-2 presence-ceil present">Mange</span>
            @else
                <span
                    class="row-start-1 row-end-2 presence-ceil absent">Absent</span>
            @endif

            @if($presence->sleep_at_home)
                <span class="row-start-2 row-end-3 presence-ceil present">Dors</span>
            @else
                <span
                    class="row-start-2 row-end-3 presence-ceil absent">Absent</span>
            @endif
        @endif
    </div>
    @can('update', $presence)
        <div class="px-2 py-4 absolute inset-0 grid grid-rows-2 grid-cols-presence-action gap-1">
            <button wire:click="toggleAll()" class="presence-ceil row-span-2 col-span-1 button">
                <x-heroicon-o-arrow-path class="icon"/>
            </button>
            <button wire:click="toggleEat()" class="presence-ceil col-span-1 button">
                @if($presence->eat_at_home)
                    Absent
                @else
                    Mange
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
