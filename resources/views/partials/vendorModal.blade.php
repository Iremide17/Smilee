<x-form action="{{ route('smilee.vendors.store') }}" has-files>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="font-bold uppercase modal-title">
                Create vendor's account
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <div class="row">
                <div class="col-sm-6 mb-2">
                    <x-form.label for="banner" value="{{ __('Business Image') }}" />
                    <x-form.input id="image" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="file" name="image" :value="old('image')" required autofocus />
                    <x-form.error for="image" />
                </div>
                <div class="col-sm-6 mb-2">
                    <x-form.label for="banner" value="{{ __('Business Banner') }}" />
                    <x-form.input id="banner" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="file" name="banner" :value="old('banner')" required autofocus />
                    <x-form.error for="banner" />
                </div>
            </div>
            
            <div class="row">
                
                <div class="col-sm-6 mb-2">
                    <x-form.label for="name" value="{{ __('Business Name') }}" />
                    <x-form.input id="name" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="name" :value="old('name')" required autofocus />
                    <x-form.error for="name" />
                </div>  

                <div class="col-sm-6 mb-2">
                    <x-form.label for="phone" value="{{ __('Business Phone Number') }}" />
                    <x-form.input id="phone" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="tel" name="phone" :value="old('phone')" required autofocus />
                    <x-form.error for="phone" />
                </div>

                <div class="col-sm-6 mb-2">
                    <x-form.label for="address" value="{{ __('Business Location') }}" />
                    <x-form.input id="address" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="address" name="address" :value="old('address')" required autofocus />
                    <x-form.error for="address" />
                </div>

                <div class="col-sm-6 mb-2">
                    <x-form.label for="email" value="{{ __('Business Email') }}" />
                    <x-form.input id="email" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus />
                    <x-form.error for="email" />
                </div>

                <div class="col-sm-6 mb-2">
                    <x-form.label for="categories" value="{{ __('Business Category') }}" />
                    <select name="categories[]" id="categories" x-data="{}" x-init="function () { choices($el) }" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" multiple>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id() }}">{{ $category->name() }}</option>
                        @endforeach
                    </select>                                
                    <x-form.error for="categories" />
                </div>

                <div class="col-sm-6 mb-2">
                    <x-form.label for="description" value="{{ __('Business Description') }}" />
                    <x-form.input id="description" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="description" :value="old('description')" required autofocus />
                    <x-form.error for="description" />
                </div>
                <input type="hidden" name="lat">
                <input type="hidden" name="long">
            </div>
            <div class="row m-6">
                <div class="col-sm-12">

                    <strong><i class="fas fa-globe mr-1"></i> Social Links</strong>

                    <hr>

                    <div class="row mt-4">

                        <div class="col-sm-12 mb-2">
                            <x-form.label for="instagram" value="{{ __('Instagram') }}" />
                            <x-form.input id="instagram" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="instagram" :value="old('instagram')" required autofocus />
                            <x-form.error for="instagram" />
                        </div>

                        <div class="col-sm-12 mb-2">
                            <x-form.label for="facebook" value="{{ __('Facebook') }}" />
                            <x-form.input id="facebook" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" type="text" name="facebook" :value="old('facebook')" required autofocus />
                            <x-form.error for="facebook" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
</x-form> 