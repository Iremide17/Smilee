<div class="px-2 py-1 text-xs text-gray-500 transition duration-100 rounded hover:bg-red-400">

    <a wire:click="confirmGalleryDeletion" wire:loading.attr="disabled" class="cursor-pointer">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>

    <x-jet-dialog-modal wire:model="confirmingGalleryDeletion">
        <x-slot name="title">
            {{ __("Delete Gallery") }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete Gallery?!') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingGalleryDeletion')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="deleteGallery" wire:loading.attr="disabled">
                {{ __('Delete Gallery') }}
            </x-jet-danger-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
