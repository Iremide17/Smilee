<div>
    <x-buttons.custom wire:click="confirmPurchhase" class="cursor-pointer">
            Purchase
            <div wire:loading.delay>
                <x-animations.ballbeat />
            </div>
    </x-buttons.custom>

    <x-jet-dialog-modal wire:model="confirmFurniturePurchase">
        <x-slot name="title">
            {{ __("Purchase Furniture") }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to purchase this furniture?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmFurniturePurchase')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="purchaseFurniture" wire:loading.attr="disabled">
                {{ __('Purchase') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
