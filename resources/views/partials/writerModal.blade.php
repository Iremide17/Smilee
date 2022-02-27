<x-form action="{{ route('smilee.authors.store') }}" has-files>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="font-bold uppercase modal-title">
                Create writer's account
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <strong><i class="fas fa-globe mr-1"></i> Social Links</strong>
                    <hr>
                    <div class="row mt-4">

                        <div class="col-sm-6 mb-2">
                            <x-form.label for="facebook" value="{{ __('Facebook') }}" />
                            <x-form.input id="facebook"
                                class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                type="text" name="facebook" :value="old('facebook')" required autofocus />
                            <x-form.error for="facebook" />
                        </div>

                        <div class="col-sm-6 mb-2">
                            <x-form.label for="instagram" value="{{ __('Instagram') }}" />
                            <x-form.input id="instagram"
                                class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                type="text" name="instagram" :value="old('instagram')" required autofocus />
                            <x-form.error for="instagram" />
                        </div>

                        <div class="col-sm-6 mb-2">
                            <x-form.label for="twitter" value="{{ __('twitter') }}" />
                            <x-form.input id="twitter"
                                class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                type="text" name="twitter" :value="old('twitter')" required autofocus />
                            <x-form.error for="twitter" />
                        </div>

                        <div class="col-sm-6 mb-2">
                            <x-form.label for="linkedin" value="{{ __('linkedin') }}" />
                            <x-form.input id="linkedin"
                                class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                type="text" name="linkedin" :value="old('linkedin')" required autofocus />
                            <x-form.error for="linkedin" />
                        </div>

                        <div class="col-md-12">
                            {{-- bio --}}
                            <div>
                                <x-form.label for="bio" value="{{ __('Company Info') }}" />
                                <x-form.textarea id="bio" class="block w-full mt-1" type="text"
                                    name="bio" :value="old('bio')" required />
                                <x-form.error for="bio" />
                            </div>
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