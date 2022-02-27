<div class="col-lg-4 col-xl-3">
    <aside class="col-span-1 space-y-8" data-aos="fade-left" data-aos-duration="500">

        {{-- About Author --}}
        <div class="p-6 space-y-8 border border-gray-200">
            <h2 class="relative font-serif text-2xl font-bold text-center">
                <span class="side-title">
                    About Author
                </span>
            </h2>
            <div class="">
                <img src="{{ $author->profile_photo_url }}" alt="{{ $author->name() }}">
            </div>

            <div class="">
                <p class="text-sm tracking-wide text-gray-700">
                    {{ $author->bioWriterExcerpt() }}
                </p>
            </div>

            {{-- Stats --}}
            <div class="">
                <span class="px-4 py-1 text-white bg-gray-800">
                    [{{ count($author->writer->posts()) }}]  
                    {{ Illuminate\Support\Str::plural('Post', count($author->writer->posts())) }}
                </span>
            </div>

            {{-- Socials --}}
            <div class="flex space-x-4">
                <x-social.profile :author="$author"/>
            </div>

            {{-- Button --}}
            <a class="block" href="{{ route('profile',$author->username) }}">
                View Profile
            </a>
        </div>

        {{-- Popular Posts --}}
        <div class="p-6 space-y-8 border border-gray-200">
            <h2 class="relative font-serif text-2xl font-bold text-center">
                <span class="side-title">
                    Popular Posts
                </span>
            </h2>
            <div class="flex flex-col space-y-8">

                @forelse ($populars as $popular)
                    <div class="grid grid-cols-3 gap-5">
                        <div class="col-span-1">
                            <img class="object-cover" src="{{ asset('storage/'.$popular->image()) }}" alt="{{ $popular->title }}">
                        </div>
                        <div class="col-span-2">
                            <h2 class="font-serif">{{  $popular->excerpt(50) }}</h2>
                        </div>
                    </div>
                @empty
                    <span class="text-center">
                        No posts yet
                    </span>
                @endforelse
            </div>
        </div>

        {{-- Tags --}}
        <div class="p-6 space-y-8 border border-gray-200">
            <h2 class="relative font-serif text-2xl font-bold text-center">
                <span class="side-title">
                    Tags
                </span>
            </h2>

            <div class="flex flex-wrap gap-3">
                @foreach ($tags as $tag)
                    <x-link.main href="{{ route('smilee.tags.show', $tag) }}">
                        {{ $tag->name() }}
                    </x-link.main>
                @endforeach
            </div>
        </div>
    </aside>
</div>

