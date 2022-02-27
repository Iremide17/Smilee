<article class="p-5 bg-white shadow">

    <div class="flex flex-col col-span-3 gap-y-4">

        <x-box.thread :thread="$thread">
            <x-slot name="user">

            </x-slot>
            <x-slot name="body">
                <a href="{{ route('smilee.threads.show', [$thread->category->slug(), $thread->slug()]) }}" class="space-y-2">
                    <h2 class="text-xl tracking-wide hover:text-blue-400">
                        {{ $thread->title() }}
                    </h2>
                    <p class="text-gray-500">
                        {{ $thread->excerpt() }}
                    </p>
                </a>
            </x-slot>

            <x-slot name="button">
                <div class="flex space-x-6">

                    {{-- Likes Count --}}
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-heart class="w-5 h-5 text-red-300" />
                        <span class="text-xs text-gray-500">{{ count($thread->likes()) }}</span>
                    </div>
            
                    {{-- Comments Count --}}
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-chat-alt class="w-4 h-4 text-green-300" />
                        <span class="text-xs text-gray-500">{{ count($thread->comments()) }}</span>
                    </div>
            
                    {{-- Views Count --}}
                    <div class="flex items-center space-x-2">
                        <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                        <span class="text-xs text-gray-500">{{ views($thread)->count() }}</span>
                    </div>
            
                    {{-- Post Date --}}
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs text-gray-500">{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </x-slot>
        </x-box.thread>

       

        {{-- Tags --}}
        <div class="absolute right-2">
            <div class="flex space-x-2">
                @foreach($thread->tags() as $tag)
                <a href="{{ route('smilee.threads.tags.index', $tag->slug()) }}" class="p-1 text-xs text-white bg-green-400 rounded">
                    {{ $tag->name() }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</article>