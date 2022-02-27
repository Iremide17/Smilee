<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:pages.vendor.index>
    </div>
</x-app-layout>