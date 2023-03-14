<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task-Man') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('project-component')
    </div>
</x-app-layout>
