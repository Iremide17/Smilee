<div>
    <x-jet-form-section submit="updateApplicationInformation">

        <x-slot name="title">
            {{ __('Application Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your application\'s information.') }}
        </x-slot>

        <x-slot name="form">
                    <!-- Profile Photo -->
                        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                            <!-- Profile Photo File Input -->
                            <input type="file" class="hidden"
                                        wire:model="photo"
                                        x-ref="photo"
                                        x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                        " />

                            <x-jet-label for="photo" value="{{ __('Photo') }}" />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ asset('storage/' . $this->application->image()) }}" alt="{{ $this->application->name() }}" class="object-cover w-20 h-20 rounded-full">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview">
                                <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                                      x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-jet-secondary-button>

                            @if ($this->application->image())
                                <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteApplicationPhoto">
                                    {{ __('Remove Photo') }}
                                </x-jet-secondary-button>
                            @endif

                            <x-jet-input-error for="photo" class="mt-2" />
                        </div>

                     <!-- Site Name -->
                     <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="block w-full mt-1" wire:model.defer="app.name" autocomplete="name" />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Site Alias -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="alias" value="{{ __('Alias') }}" />
                        <x-jet-input id="alias" type="text" class="block w-full mt-1" wire:model.defer="app.alias" autocomplete="alias" />
                        <x-jet-input-error for="alias" class="mt-2" />
                    </div>
                    <!-- Site Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="email" class="block w-full mt-1" wire:model.defer="app.email" />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>
                    <!-- Site line 1 -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="line1" value="{{ __('Mobile Number 1') }}" />
                        <x-jet-input id="line1" type="text" class="block w-full mt-1" wire:model.defer="app.line1" autocomplete="line1" />
                        <x-jet-input-error for="line1" class="mt-2" />
                    </div>
                    <!-- Site line2 -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="line2" value="{{ __('Mobile Line 2') }}" />
                        <x-jet-input id="line2" type="text" class="block w-full mt-1" wire:model.defer="app.line2" autocomplete="line2" />
                        <x-jet-input-error for="line2" class="mt-2" />
                    </div>
                    <!-- Site slogan -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="slogan" value="{{ __('Slogan') }}" />
                        <x-jet-input id="slogan" type="text" class="block w-full mt-1" wire:model.defer="app.slogan" autocomplete="slogan" />
                        <x-jet-input-error for="slogan" class="mt-2" />
                    </div>

                    <!-- Site motto -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="motto" value="{{ __('Motto') }}" />
                        <x-jet-input id="motto" type="text" class="block w-full mt-1" wire:model.defer="app.motto" autocomplete="motto" />
                        <x-jet-input-error for="motto" class="mt-2" />
                    </div>

                    <!-- Site whatsapp -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="whatsapp" value="{{ __('Whatsapp') }}" />
                        <x-jet-input id="whatsapp" type="text" class="block w-full mt-1" wire:model.defer="app.whatsapp" autocomplete="whatsapp" />
                        <x-jet-input-error for="whatsapp" class="mt-2" />
                    </div>

                    <!-- Site facebook -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="facebook" value="{{ __('Facebook') }}" />
                        <x-jet-input id="facebook" type="text" class="block w-full mt-1" wire:model.defer="app.facebook" autocomplete="facebook" />
                        <x-jet-input-error for="facebook" class="mt-2" />
                    </div>

                    <!-- Site instagram -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="instagram" value="{{ __('Instagram') }}" />
                        <x-jet-input id="instagram" type="text" class="block w-full mt-1" wire:model.defer="app.instagram" autocomplete="instagram" />
                        <x-jet-input-error for="instagram" class="mt-2" />
                    </div>

                    <!-- Site address -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" type="text" class="block w-full mt-1" wire:model.defer="app.address" autocomplete="address" />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    <!-- Site description -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <x-jet-input id="description" type="text" class="block w-full mt-1" wire:model.defer="app.description" autocomplete="description" />
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <!-- Site terms -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="terms" value="{{ __('Terms') }}" />
                        <x-jet-input id="terms" type="text" class="block w-full mt-1" wire:model.defer="app.terms" autocomplete="terms" />
                        <x-jet-input-error for="terms" class="mt-2" />
                    </div>

                    <!-- Site policy -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="policy" value="{{ __('Policy') }}" />
                        <x-jet-input id="policy" type="text" class="block w-full mt-1" wire:model.defer="app.policy" autocomplete="policy" />
                        <x-jet-input-error for="policy" class="mt-2" />
                    </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
