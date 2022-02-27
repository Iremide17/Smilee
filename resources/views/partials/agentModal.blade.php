<x-form action="{{ route('smilee.agent.store') }}" has-files>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="font-bold uppercase modal-title">
                Create agent's account
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="space-y-12">

                <input type="hidden" name="type" value="agent">

                <div class="row">
                    <div class="col-md-3">
                        {{-- Image --}}
                        <div>
                            <div class="custom-file">
                                <x-form.label for="image" value="{{ __('Company Logo') }}"  class="custom-file-label" for="customFile" />
                                <x-form.file id="image" class="block w-full mt-1" name="image" :value="old('image')" required />
                                <x-form.error for="image" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="name" value="{{ __('Name') }}" />
                            <x-form.input id="name" class="block w-full mt-1" type="text" name="name"
                                :value="old('name')" required />
                            <x-form.error for="name" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="name" value="{{ __('Company Name') }}" />
                            <x-form.input id="name" class="block w-full mt-1" type="text" name="name"
                                :value="old('name')" required />
                            <x-form.error for="name" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="email" value="{{ __('Company Email') }}" />
                            <x-form.input id="email" class="block w-full mt-1" type="email" name="email"
                                :value="old('email')" required />
                            <x-form.error for="email" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="phone" value="{{ __('Company Phone Line') }}" />
                            <x-form.input id="phone" class="block w-full mt-1" type="tel" name="phone"
                                :value="old('phone')" required />
                            <x-form.error for="phone" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="address" value="{{ __('Company Address') }}" />
                            <x-form.input id="address" class="block w-full mt-1" type="address" name="address"
                                :value="old('address')" required />
                            <x-form.error for="address" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                        <x-form.label for="instagram" value="{{ __('Company Instagram') }}" />
                            <x-form.input id="instagram" class="block w-full mt-1" type="text" name="instagram"
                                :value="old('instagram')" required />
                            <x-form.error for="instagram" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="facebook" value="{{ __('Company Facebook') }}" />
                            <x-form.input id="facebook" class="block w-full mt-1" type="text" name="facebook"
                                :value="old('facebook')" required />
                            <x-form.error for="facebook" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="twitter" value="{{ __('Company Twitter') }}" />
                            <x-form.input id="twitter" class="block w-full mt-1" type="text" name="twitter"
                                :value="old('twitter')" required />
                            <x-form.error for="twitter" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="linkedin" value="{{ __('Company Linkedin') }}" />
                            <x-form.input id="linkedin" class="block w-full mt-1" type="text" name="linkedin"
                                :value="old('linkedin')" required />
                            <x-form.error for="linkedin" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="area_covered" value="{{ __('Area Covered') }}" />
                            <x-form.input id="area_covered" class="block w-full mt-1" type="text" name="area_covered"
                                :value="old('area_covered')" required />
                            <x-form.error for="area_covered" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="website" value="{{ __('Company Website') }}" />
                            <x-form.input id="website" class="block w-full mt-1" type="text" name="website"
                                :value="old('website')" required />
                            <x-form.error for="website" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- Name --}}
                        <div>
                            <x-form.label for="language" value="{{ __('Fluent Language') }}" />
                            <x-form.input id="language" class="block w-full mt-1" type="text" name="language"
                                :value="old('language')" required />
                            <x-form.error for="language" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{-- Description --}}
                        <div>
                            <x-form.label for="description" value="{{ __('Company Info') }}" />
                            <x-form.textarea id="description" class="block w-full mt-1" type="text"
                                name="description" :value="old('description')" required />
                            <x-form.error for="description" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
            </div>
        </div>
</x-form>
