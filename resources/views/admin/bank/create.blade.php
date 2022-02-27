<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Questions: Create') }}
        </h2>
    </x-slot>

    <section class="mx-6">
        <div class="p-8">
            <x-form action="{{ route('admin.banks.store') }}" has-files>
                <div class="space-y-8">

                    {{-- content --}}
                    <div>
                        <x-form.label for="content" value="{{ __('Content') }}" />
                        <x-form.input id="content" class="block w-full mt-1" type="file" :value="old('content')" name="content" required />
                        <x-form.error for="content" />
                    </div>

                    {{-- Name --}}
                    <div>
                        <x-form.label for="name" value="{{ __('Name') }}" />
                        <x-form.input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required />
                        <x-form.error for="name" />
                    </div>

                    {{-- semester --}}
                    <div class="">
                        <x-form.label for="semesters" value="{{ __('Semester') }}" />
                        <select name="semesters[]" id="semesters" multiple x-data="{}" x-init="function () { choices($el) }" :value="old('semesters')">
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id() }}">{{ $semester->name() }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- session --}}
                    <div class="">
                        <x-form.label for="levels" value="{{ __('Level') }}" />
                        <select name="levels[]" id="levels" multiple x-data="{}" x-init="function () { choices($el) }" :value="old('levels')">
                            @foreach ($levels as $level)
                                <option value="{{ $level->id() }}">{{ $level->name() }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div>
                        <x-form.label for="description" value="{{ __('Description') }}" />
                        <x-form.textarea id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required />
                        <x-form.error for="description" />
                    </div>

                    {{-- Button --}}
                    <x-buttons.primary class="float-right">
                        {{ __('Create') }}
                    </x-buttons.primary>
            </x-form>
        </div>
    </section>
</x-app-layout>
