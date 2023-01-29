<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Présences
        </h1>
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 space-y-4">
        @if(auth()->user()->are_default_presences_empty)
            <section class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col gap-4">
                <h2 class="text-gray-900 text-2xl">Gagnez du temps</h2>
                <p>Vous êtes présent les mêmes jours chaque semaine, ou presque ? Vous pouvez remplir en un clin d'œil
                    chaque jour avec la semaine type !</p>
                <a href="{{ route('default-week') }}"
                   class="px-4 py-2 rounded-md bg-blue-600 text-white flex gap-2 mr-auto">
                    <span>Configurer ma semaine type</span>
                    <x-heroicon-o-calendar-days class="icon"/>
                </a>
            </section>
        @endif
        <section class="bg-white shadow-sm sm:rounded-lg py-6 space-y-4">
            <h2 class="text-gray-900 text-2xl px-6">Yaki à la maison?</h2>

            <livewire:presences-table/>
        </section>
    </section>
</x-app-layout>
