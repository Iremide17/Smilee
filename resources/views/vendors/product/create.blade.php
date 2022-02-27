<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Create Product') }}
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
                <div class="space-y-8">

                    <div class="col-sm-12">
                        <div class="row">
                            
                            <div class="col-sm-4">
                                <div class="flex flex-row justify-center">
                                    <div class="mt-4">
                                        <x-buttons.custom id="uploadImage1">
                                            {{ __('First Image') }}
                                        </x-buttons.custom>
                                        <x-form.error for="image1" />
                                    </div>
                                    <div>
                                        <img src="{{ asset('default.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover" id="first">
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-sm-4">
                                <div class="flex flex-row justify-center">
                                    <div class="mt-4">
                                        <x-buttons.custom id="uploadImage2">
                                            {{ __('Second Image') }}
                                        </x-buttons.custom>
                                        <x-form.error for="image2" />
                                    </div>
                                    <div>
                                        <img src="{{ asset('default.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover" id="second">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="flex flex-row justify-center">
                                    <div class="mt-4">
                                        <x-buttons.custom id="uploadImage3">
                                            {{ __('Third Image') }}
                                        </x-buttons.custom>
                                        <x-form.error for="image3" />
                                    </div>
                                    <div>
                                        <img src="{{ asset('default.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover" id="third">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <x-form action="{{ route('vendor.product.store') }}" has-files>

                        <x-form.input id="image1" class="d-none" type="file" name="image" onchange="readFirst(this);" />
                        <x-form.input id="image2" class="d-none" type="file" name="image2" onchange="readSecond(this);" />
                        <x-form.input id="image3" class="d-none" type="file" name="image3" onchange="readThird(this);"/>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                {{-- title --}}
                                <div>
                                    <x-form.label for="title" value="{{ __('Product Name') }}" />
                                    <x-form.input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" required />
                                    <x-form.error for="title" />
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <x-form.label for="price" value="{{ __('Product Price') }}" />
                                <x-form.input id="price" class="block w-full mt-1" type="number" name="price" :value="old('price')" />
                                <x-form.error for="price" />
                            </div>

                            {{-- category --}}
                            <div class="col-sm-6 mt-2">
                                <x-form.label for="categories" value="{{ __('Category') }}" />
                                <select name="categories[]" id="categories" x-data="{}" x-init="function () { choices($el) }" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" multiple>
                                    @foreach ($categories as $id => $category)
                                        <option value="{{ $category->id() }}">{{ $category->name() }}</option>
                                    @endforeach
                                </select>                                
                                <x-form.error for="categories" />
                            </div>

                            <div class="col-sm-6 mb-2">
                                <x-form.label for="type" value="{{ __('Product Type') }}" />
                                <select name="type" id="type" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="old">Old</option>
                                    <option value="new">New</option>
                                </select>
                                <x-form.error for="type" />
                            </div>
                            
                            <div class="col-sm-12 mt-4">
                                {{-- Description --}}
                                <div>
                                    <x-form.label for="description" value="{{ __('Description') }}" />
                                    <x-form.textarea id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required />
                                    <x-form.error for="description" />
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <x-checkbox name="is_commentable" value="1"/> 
                                <span class="text-xs font-bold text-blue-500 uppercase">Disable comments</span>
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
        $('#uploadImage3').click(function(){
            $('#image3').trigger('click');
        });

        function readThird(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#third')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>

    <script>
        $('#uploadImage2').click(function(){
            $('#image2').trigger('click');
        });

        function readSecond(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#second')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>

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

