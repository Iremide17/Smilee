<aside class="col-span-1 space-y-8" data-aos="fade-left" data-aos-duration="500">

        {{-- categories --}}
        <div class="p-6 space-y-8 border border-gray-200">
            <h2 class="relative font-serif text-2xl font-bold text-center">
                <span class="side-title">
                    Categories
                </span>
            </h2>

            <div class="flex flex-wrap gap-3">
                @foreach ($categories as $category)
                    <a href="#" class="flex items-center justify-between">
                        {{ $category->name() }}
                        <span class="px-2 text-white bg-green-300 rounded">45</span>
                    </a>
                @endforeach
            </div>
        </div>

          {{-- categories --}}
          <div class="p-6 space-y-8 border border-gray-200">
            <div class="pb-4 space-y-4">

                @can(App\Policies\ThreadPolicy::UNSUBSCRIBE, $thread)
                {{-- Unubscribe to thread button --}}
                <x-link.main href="{{ route('smilee.threads.unsubscribe', [$thread->category->slug(), $thread->slug()]) }}">
                    {{ __('Unsubscribe to Thread') }}
                </x-link.main>
                <p class="text-sm text-gray-500 ">
                    Unsubscribe from this thread.
                </p>
    
                @elsecan(App\Policies\ThreadPolicy::SUBSCRIBE, $thread)
                {{-- Subscribe to thread button --}}
                <x-link.main href="{{ route('smilee.threads.subscribe', [$thread->category->slug(), $thread->slug()]) }}">
                    {{ __('Subscribe to Thread') }}
                </x-link.main>
                <p class="text-sm text-gray-500 ">
                    Subscribe to this thread.
                </p>
                @endcan
    
            </div>
        </div>
    </aside>