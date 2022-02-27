<div class="px-2 py-1 text-xs text-gray-500 transition duration-100 rounded hover:bg-red-400">

    <a wire:click="confirmFurnitureDeletion" wire:loading.attr="disabled" class="cursor-pointer">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>

    <x-jet-dialog-modal wire:model="confirmingFurnitureDeletion">
        <x-slot name="title">
            {{ __("Delete Furniture") }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Furniture?!') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingFurnitureDeletion')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deleteFurniture" wire:loading.attr="disabled">
                {{ __('Delete Furniture') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
