<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Application Products') }}
        </h2>
        <p>
            All Products from vendor
        </p>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <livewire:admin.product.index />            
        </div>
    </div>
</x-app-layout>
