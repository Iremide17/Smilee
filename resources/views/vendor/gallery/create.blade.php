<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Create Gallery') }}
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="space-y-8">

                    <div class="col-sm-12">
                        <div class="flex flex-row justify-center">
                            <div class="mt-4">
                                <x-buttons.custom id="uploadImage1">
                                    {{ __('Image') }}
                                </x-buttons.custom>
                                <x-form.error for="image1" />
                            </div>
                            <div>
                                <img src="{{ asset('default.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover" id="first">
                            </div>
                        </div>
                    </div>
                    
                    <x-form action="{{ route('vendor.gallery.store') }}" has-files>

                        <x-form.input id="image1" class="d-none" type="file" name="image" onchange="readFirst(this);" />

                        <div class="row">
                            <div class="col-sm-12">
                                {{-- title --}}
                                <div>
                                    <x-form.label for="name" value="{{ __('name') }}" />
                                    <x-form.input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required />
                                    <x-form.error for="name" />
                                </div>
                            </div>
                            
                            <div class="col-sm-12 mt-4">
                                {{-- Description --}}
                                <div>
                                    <x-form.label for="description" value="{{ __('Description') }}" />
                                    <x-form.textarea id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required />
                                    <x-form.error for="description" />
                                </div>
                            </div>
                             {{-- Button --}}
                            <div class="col-sm-12 mt-4">
                                <div class="float-right">
                                    <x-buttons.primary>
                                        {{ __('Create') }}
                                    </x-buttons.primary>
                                </div>
                            </div>
                        </div>
                    </x-form>
                </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('#uploadImage1').click(function(){
                $('#image1').trigger('click');
            });

            function readFirst(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#first')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
        </script>
    @endpush
</x-app-layout>

