<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
         {{ __('Thread:') }} {{ $thread->title() }}
        </h2>
        <p>
            <small class="text-sm text-white">Threads>{{ $category->name() }}>{{ $thread->title() }}</small>
        </p>
    </x-slot>

    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <x-partials.sidenav :thread="$thread" :author="$thread->author()" :tags="$tags" :categories="$categories"/>
        </div>
        
        <div class="col-md-8 gap-8 mt-8 wrapper">

            <section class="flex flex-col col-span-3 gap-y-4">
    
                <x-box.thread :thread="$thread">

                    <x-slot name="user">

                    </x-slot>

                    <x-slot name="body">
                        <h2 class="text-xl tracking-wide hover:text-blue-400">
                            {{ $thread->title() }}
                        </h2>
                        <div class="text-gray-500 mt-1">
                            {!! $thread->body() !!}
                        </div>
                    </x-slot>

                    <x-slot name="button">
                        <div class="flex space-x-5 text-gray-500">
                            {{-- Likes --}}
                            <livewire:pages.thread.like-thread :thread="$thread" />
            
                            {{-- View Count --}}
                            <div class="flex items-center space-x-2">
                                <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                                <span class="text-xs text-gray-500">{{ views($thread)->count() }}</span>
                            </div>
                        </div>
            
                        {{-- Date Posted --}}
                        <div class="flex items-center text-xs text-gray-500">
                            <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                            Posted: {{ $thread->created_at->diffForHumans() }}
                        </div>
                    </x-slot>

                    <x-slot name="action">
                        @can(App\Policies\ThreadPolicy::UPDATE, $thread)
                        <x-link.secondary href="{{ route('smilee.threads.edit', $thread->slug()) }}">
                            Edit
                        </x-link.secondary>
                        @endcan
        
                        @can(App\Policies\ThreadPolicy::DELETE, $thread)
                            <livewire:pages.thread.delete :thread="$thread" :key="$thread->id()" />
                        @endcan
                    </x-slot>

                </x-box.thread>
    
                {{-- comments --}}
                <x-posts.comments :model="$thread" :type="$thread->commentType()" />
    
            </section>
        </div>
    </div>
</x-app-layout>
