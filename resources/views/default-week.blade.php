<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Semaine type
        </h1>
    </x-slot>

    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <section class="bg-white shadow-sm sm:rounded-lg py-6 space-y-4">
            <h2 class="text-gray-900 text-2xl px-6">Vous avez des habitudes?</h2>

            <livewire:default-week-presence-edition/>
        </section>
    </section>
</x-app-layout>
