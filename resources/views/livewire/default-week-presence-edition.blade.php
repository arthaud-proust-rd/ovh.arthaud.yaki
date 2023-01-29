<section class="px-4 flex flex-col overflow-auto ">
    <section class="presence-row">
        <section class="px-2">
            <span class="presence-ceil flex-col items-start p-2">
                Jours
            </span>
        </section>
        @foreach($this->daysOfWeek as $day)
            <section class="px-2">
                <span class="presence-ceil flex-col p-2">
                    {{ $day->translatedFormat('l') }}
                </span>
            </section>
        @endforeach
    </section>
    <section class="presence-row">
        <section class="p-4 flex justify-center flex-col">
            Présence
        </section>
        @foreach($me->defaultPresencesOfWeek($this->daysOfWeek) as $defaultPresence)
            <livewire:default-presence-card :user="$me" :default-presence="$defaultPresence"
                                            :wire:key="'default-presence-'.Str::orderedUuid()"/>
        @endforeach
    </section>
</section>
