<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
         {{ __('Thread') }}
        </h2>
        <p>
            Topics and issues raised
        </p>
    </x-slot>

    <div class="col-md-12 gap-8 mt-8 wrapper">
        <section class="flex flex-col col-span-3 gap-y-4">
            @foreach ($threads as $thread)
            <x-thread :thread="$thread" />
            @endforeach

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $threads->render() }}
            </div>
        </section>
    </div>
</x-app-layout>
