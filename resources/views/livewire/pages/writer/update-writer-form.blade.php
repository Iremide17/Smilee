<x-jet-form-section submit="updateWriterLink">
    <x-slot name="title">
        {{ __(' Update  your writer profile') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure you enter your correct social media account links, bio and present level.') }}
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="facebook" value="{{ __('Facebook') }}" />
            <x-jet-input id="facebook" type="text" class="block w-full mt-1" wire:model.defer="writer.facebook" />
            <x-jet-input-error for="facebook" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="'twitter'" value="{{ __('Twitter') }}" />
            <x-jet-input id="twitter" type="text" class="block w-full mt-1" wire:model.defer="writer.twitter" />
            <x-jet-input-error for="twitter" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="instagram" value="{{ __('Instagram') }}" />
            <x-jet-input id="instagram" type="text" class="block w-full mt-1" wire:model.defer="writer.instagram" />
            <x-jet-input-error for="instagram" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="linkedin" value="{{ __('Linkedin') }}" />
            <x-jet-input id="linkedin" type="text" class="block w-full mt-1" wire:model.defer="writer.linkedin" />
            <x-jet-input-error for="linkedin" class="mt-2" />
        </div>

        {{-- Bio --}}
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bio" value="{{ __('Bio') }}" />
            <x-jet-input id="bio" type="text" class="block w-full mt-1" wire:model.defer="writer.bio" />
            <x-jet-input-error for="bio" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="updated">
            {{ __('updated other writer informations.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
