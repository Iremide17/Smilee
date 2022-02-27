<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Tags') }}
        </h2>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <section class="container pt-16 mx-auto mb-32">
                <div class="row">
                    @foreach ($tags as $tag)
                       <div class="col-md-3 transition duration-500 transform shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
                            <a href="{{ route('smilee.tags.show', $tag) }}" class="relative col-span-1 cursor-pointer hover:shadow">
                
                                <img class="w-full h-full transition-all obeject-cover opacity-80 duration-250 hover:opacity-100" src="{{ asset('storage/' . $tag->image()) }}" alt="{{ $tag->name() }}">
                
                                <h2 class="absolute inset-x-auto w-full py-2 font-serif text-5xl font-bold text-center text-white bg-gray-600 bg-opacity-50 text-shadow top-2/4">
                                    {{ $tag->name() }}
                                </h2>
                            </a>
                       </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
