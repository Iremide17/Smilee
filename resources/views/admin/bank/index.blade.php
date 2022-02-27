<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Application Past Questions') }}
        </h2>
        <p>
            Past questions based on year and semester
        </p>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @livewire('admin.bank.index')            
        </div>
    </div>
</x-app-layout>
