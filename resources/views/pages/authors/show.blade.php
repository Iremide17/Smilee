<x-app-layout>
    
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ $author->name() }}
        </h2>
    </x-slot>

    <section class="container mx-auto">

        <header class="flex flex-col py-8 mt-8 mb-12 space-y-8 text-center">
            <h2 class="font-serif text-4xl font-bold">
                {{ $author->name() }} latest posts
            </h2>
            <hr class="self-center w-40 border-b-4 border-theme-blue-200">
        </header>

        <div class="post-container">
            <div class="row">
                @foreach ($posts as $post)
                    <x-posts.latest :post="$post" />
                @endforeach
            </div>
        </div>

        @if($posts->hasPages())
        <div class="p-4 mb-20 bg-gray-200">
            {{ $posts->links() }}
        </div>
        @endif

    </section>

</x-app-layout>