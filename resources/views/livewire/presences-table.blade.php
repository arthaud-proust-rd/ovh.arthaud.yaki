<section class="px-4 flex flex-col overflow-auto ">
    <div class="sticky top-0 bg-white z-40 w-min">
        <section class="presence-row">
            <div class="grid grid-cols-2 pr-2">
                <button wire:click="previousWeek()"
                        class="p-2 flex items-center justify-center rounded-md hover:bg-gray-100">
                    <x-heroicon-o-chevron-double-left class="icon"/>
                </button>
                <button wire:click="nextWeek()"
                        class="p-2 flex items-center justify-center rounded-md hover:bg-gray-100">
                    <x-heroicon-o-chevron-double-right class="icon"/>
                </button>
            </div>
            @foreach($this->daysOfWeek as $day)
                <div class="ceil flex-col">
                    <span>{{ $day->translatedFormat('l') }}</span>
                    <span>{{ $day->translatedFormat('d') }}</span>
                </div>
            @endforeach
        </section>
        <section class="presence-row mb-2 rounded-xl shadow-lg">
            <span class="p-4 flex items-center">{{$me->name }}</span>
            @foreach($me->presencesOfWeek($this->daysOfWeek) as $presence)
                <livewire:presence-card :user="$me" :presence="$presence" :wire:key="'presence-'.Str::orderedUuid()"/>
            @endforeach
        </section>

        <section class="presence-row">
            <section class="pt-6 pb-4 px-2 flex items-center font-bold">
                Total
            </section>

            @foreach($dayCounts as $dayCount)
                <x-presence-resume :count="$dayCount"/>
            @endforeach
        </section>
    </div>

    @foreach($otherUsers as $user)
        <section class="presence-row">
            <span class="p-4 flex items-center">{{$user->name }}</span>
            @foreach($user->presencesOfWeek($this->daysOfWeek) as $presence)
                <livewire:presence-card :user="$user" :presence="$presence"
                                        :wire:key="'presence-'.Str::orderedUuid()"/>
            @endforeach
        </section>
    @endforeach
</section>
