<div class="px-2 py-1 text-xs text-gray-500 transition duration-100 rounded hover:bg-red-400">

    <a wire:click="confirmProductDeletion" wire:loading.attr="disabled" class="cursor-pointer">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>

    <x-jet-dialog-modal wire:model="confirmingProductDeletion">
        <x-slot name="title">
            {{ __("Delete Product") }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Product?!') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingProductDeletion')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deleteProduct" wire:loading.attr="disabled">
                {{ __('Delete Product') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
