<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Vendor Dashboard') }}
        </h2>
        <p>
            Welcome to your dashboard {{ auth()->user()->name() }}!
        </p>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">

            <div class="container-fluid">
                <livewire:vendors.dashboard.index>
            </div>

        </div>
    </div>
</x-app-layout>

