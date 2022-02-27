<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
         {{ __('Furniture') }}
        </h2>
        <p>
            Welcome to {{ application('name') }} furniture page!
        </p>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <livewire:pages.furniture.index>
        </div>
    </div>
</x-app-layout>

