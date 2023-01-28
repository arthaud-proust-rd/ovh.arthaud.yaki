<section class="flex flex-col">
    <section>
        <button wire:click="previousWeek()">Précédent</button>
        <button wire:click="nextWeek()">Suivant</button>
    </section>
    <section class="grid grid-cols-8">
        <span>{{$me->name }}</span>
        @foreach($me->presences()->ofWeekBeginningAt($this->firstDayOfWeek)->get() as $presence)
            <span>{{ $presence->date }}</span>
        @endforeach
    </section>
    @foreach($otherUsers as $user)
        <section class="grid grid-cols-8">
            <span>{{$user->name }}</span>
            @foreach($user->presences()->ofWeekBeginningAt($this->firstDayOfWeek)->get() as $presence)
                <span>{{ $presence->date }}</span>
            @endforeach
        </section>
    @endforeach
</section>
