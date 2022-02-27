<x-app-layout>

    @section('title', application('name')." | Vendor: $vendor->name")

    @section('keywords')
    @foreach ($vendor->categories() as $category)
        {{ $category->name() }}
    @endforeach
    @endsection

    @section('description')
    {{ $vendor->name() }}
    @endsection

    @section('metaImage')
    {{ asset('storage/' . $vendor->image()) }}
    @endsection

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
          Vendor: {{ $vendor->name() }}
        </h2>
        <p>
            {{ $vendor->description() }}
        </p>
    </x-slot>

    <div class="p-2">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <section class="container mx-auto">
                
                <header class="flex flex-col py-8 mt-8 mb-12 space-y-8 text-center">
                    <h2 class="font-serif text-4xl font-bold">Furnitures: {{ $vendor->name() }}</h2>
                    <hr class="self-center w-40 border-b-4 border-theme-blue-200">
                </header>

                <div class="post-container">

                    {{-- All Posts --}}
                    <div class="row">
                        @forelse($vendor->furnitures as $furniture)   
                        <x-agent.card :model="$furniture">
                            <x-slot name="image">
                                <a href="{{ route('smilee.furnitures.show',$furniture) }}">
                                    <img class="img-whp" src="{{ asset('storage/'.$furniture->firstImage()) }}" alt="{{ $furniture->title() }}">
                                </a>
                            </x-slot>
                            <x-slot name="sub">
                                <x-slot name="price">
                                    <ul class="tag mb0">
                                        <li class="list-inline-item"><a href="#">{{ trans('global.naira') }} {{ $furniture->price() }}</a></li>
                                    </ul>
                                </x-slot>
                                <x-slot name="type">
                                    <ul class="tag2 mb0">
                                        <li class="list-inline-item"><a href="#">{{ $furniture->type() }}</a></li>
                                    </ul>
                                </x-slot>
                                <x-slot name="details">
                                    <x-slot name="small">
                                    <a href="{{ route('smilee.furnitures.furniture',['vendor' => $furniture->vendor->slug(),'furniture' => $furniture->slug() ]) }}">
                                        <img src="{{ asset('storage/'.$furniture->vendor->image()) }}" alt="{{ $furniture->vendor->name() }}">
                                    </a>
                                    </x-slot>
                                    <x-slot name="name">
                                        <h4>
                                            <a href="{{ route('smilee.furnitures.show',$furniture) }}">{{ $furniture->title() }}</a>
                                        </h4>
                                    </x-slot>
                                </x-slot>
                            </x-slot>
                            
                        </x-agent.card>
                        @empty
                            <p>No furnitures available</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

</x-app-layout>
