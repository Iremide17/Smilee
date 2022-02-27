<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <section class="container pt-16 mx-auto mb-32">
                <div class="row">
                    @foreach($authors as $author)
                        <div class="col-md-3">
                            <div class="transition duration-500 transform bg-white shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
                                <a href="{{ route('smilee.authors.show', $author) }}">
    
                                    {{-- Profile Image --}}
                                    <img class="w-full" src="{{ asset($author->profile_photo_url) }}" />
    
                                    <div class="px-4 py-4 space-y-4">
                                        <h1 class="font-serif text-2xl font-bold font-gray-700">
                                            {{ $author->name() }}
                                        </h1>
    
                                        <p class="text-sm tracking-normal">
                                            {{ $author->bioWriterExcerpt() }}
                                        </p>
    
                                        <div class="flex pt-8 space-x-4">
    
                                            @if(!empty($author->facebook()))
                                            <a href="{{ $author->facebook() }}" target="_blank">
                                                <x-fab-facebook-f class="h-4 text-theme-blue-200" />
                                            </a>
                                            @endif
    
                                            @if(!empty($author->twitter()))
                                            <a href="{{ $author->twitter() }}" target="_blank">
                                                <x-fab-twitter class="h-4 text-theme-blue-200" />
                                            </a>
                                            @endif
    
                                            @if(!empty($author->instagram()))
                                            <a href="{{ $author->instagram() }}" target="_blank">
                                                <x-fab-instagram-square class="h-4 text-theme-blue-200" />
                                            </a>
                                            @endif
    
                                            @if(!empty($author->linkedIn()))
                                            <a href="{{ $author->linkedIn() }}" target="_blank">
                                                <x-fab-linkedin-in class="h-4 text-theme-blue-200" />
                                            </a>
                                            @endif
    
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
