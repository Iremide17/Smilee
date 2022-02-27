<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="cart-section">
        <div class="auto-container">
            <div class="py-6">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

                    <div class="cart-outer">
                        <livewire:pages.product.cart />
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

