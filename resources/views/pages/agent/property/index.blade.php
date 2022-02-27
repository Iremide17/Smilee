<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
           {{ $agent->name() }} {{ __('Properties') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <livewire:pages.agent.property.show :agent='$agent'>
        </div>
    </div>
</x-app-layout>
