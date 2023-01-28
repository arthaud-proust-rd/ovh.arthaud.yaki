<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Présences
        </h1>
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
            <h2 class="text-gray-900 text-2xl">Qui est là?</h2>

            <livewire:presences-table/>
        </section>
    </section>
</x-app-layout>
