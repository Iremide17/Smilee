<x-app-layout>

    @section('title', application('name')." | Post: $post->title")

    @section('keywords')
    @foreach ($post->tags() as $tag)
        {{ $tag->name() }}
    @endforeach
    @endsection

    @section('description')
    {{ $post->title() }}
    @endsection

    @section('metaImage')
    {{ asset('storage/' . $post->image()) }}
    @endsection

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="row justify-content-center p-2">
                <div class="col-lg-8 col-xl-9">
                    @if($post->isPremium())
                        @subscribed(auth()->user())
                            <div class="main_blog_post_content">

                                <div class="blog_single_post_heading">
                                    <div class="contents">
                                        <div class="flex space-x-2 m-2">
                                            {{-- Tags --}}
                                            @foreach ($post->tags() as $tag)
                                                <a href="{{ route('smilee.tags.show', $tag) }}" class="text-sm font-bold uppercase text-theme-blue-100">{{ $tag->name() }}</a>
                                            @endforeach
                                        </div>

                                        <div class="flex justify-between">

                                            <div class="flex space-x-5 text-gray-500">

                                                {{-- posted by --}}
                                                <div class="flex items-center space-x-2 mr-2">
                                                    <x-heroicon-o-user class="w-4 h-4 text-blue-300" />
                                                    <span class="text-xs text-gray-500">{{ $post->author()->name()}}</span>
                                                </div>

                                                {{-- Likes --}}
                                                <livewire:like-post :post="$post" />

                                                {{-- View Count --}}
                                                <div class="flex items-center space-x-2 ml-2">
                                                    <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                                                    <span class="text-xs text-gray-500">{{ views($post)->count() }}</span>
                                                </div>

                                                <span class="text-gray-600">
                                                    {{ $post->readTime() }} minute(s) read
                                                </span>
                                            </div>

                                            {{-- Date Posted --}}
                                            <div class="flex items-center ml-2 text-xs text-gray-500">
                                                <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                                Posted: {{ $post->created_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        <h2 class="font-serif text-5xl font-bold mt-2">
                                            {{ $post->title() }}
                                        </h2>

                                    </div>
                                </div>

                                <div class="mbp_thumb_post">
                                    <div class="thumb mt30">
                                        <img class="w100"
                                            src="{{  asset('storage/' . $post->image()) }}"
                                            alt="{{ $post->title() }}">
                                    </div>

                                    <div class="leading-6 tracking-wide text-gray-700 mt-4">
                                        {!! $post->body() !!}
                                    </div>

                                    <hr class="mt50 mb40">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="flex flex-col items-center mb-24 space-y-4 blog_post_share">
                                                <h2 class="font-serif font-bold capitalize">Share this post</h2>

                                            {{-- social share --}}
                                                <x-social.links :blog="$post" url="{{ Request::url() }}" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr class="mt50">

                                {{-- navigation --}}
                                <div class="mbp_pagination_tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="pag_prev">
                                                <div class="detls">
                                                    <h5><span class="fa fa-angle-left mr5"></span> Previous Post</h5>
                                                    <p> Given Set was without from god divide rule Hath</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="pag_next text-right">
                                                <div class="detls">
                                                    <h5>Next Post <span class="fa fa-angle-right ml5"></span></h5>
                                                    <p> Tree earth fowl given moveth deep lesser After</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- comment --}}
                                <div class="product_single_content mt-4">
                                    {{-- comments --}}
                                        @if ($post->isCommentable())
                                            <x-posts.comments :model="$post" :type="$post->commentType()" />
                                        @endif
                                </div>

                            </div>
                        @else
                            <div class="col-span-3" data-aos="fade-up" data-aos-duration="500">

                                <div class="p-4 space-y-4 shadow">
                                    <h2 class="text-2xl text-theme-blue-200">
                                        This content is for premium user only
                                    </h2>
                                    <h2>
                                        Please subscribe to view content
                                    </h2>
                                    <x-buttons.primary href="{{ route('membership') }}">
                                        Subscribe
                                    </x-buttons.primary>
                                </div>
                            </div>
                        @endsubscribed
                    @else
                        <div class="main_blog_post_content">

                            <div class="blog_single_post_heading">
                                <div class="contents">
                                    <div class="flex space-x-2 m-2">
                                        {{-- Tags --}}
                                        @foreach ($post->tags() as $tag)
                                            <a href="{{ route('smilee.tags.show', $tag) }}" class="text-sm font-bold uppercase text-theme-blue-100">{{ $tag->name() }}</a>
                                        @endforeach
                                    </div>

                                    <div class="flex justify-between">

                                        <div class="flex space-x-5 text-gray-500">

                                            {{-- posted by --}}
                                            <div class="flex items-center space-x-2 mr-2">
                                                <x-heroicon-o-user class="w-4 h-4 text-blue-300" />
                                                <span class="text-xs text-gray-500">{{ $post->writer->user()->name()}}</span>
                                            </div>

                                            {{-- Likes --}}
                                            <livewire:pages.post.like-post :post="$post" />

                                            {{-- View Count --}}
                                            <div class="flex items-center space-x-2 ml-2">
                                                <x-heroicon-o-eye class="w-4 h-4 text-blue-300" />
                                                <span class="text-xs text-gray-500">{{ views($post)->count() }}</span>
                                            </div>

                                            <span class="text-gray-600">
                                                {{ $post->readTime() }} minute(s) read
                                            </span>
                                        </div>

                                        {{-- Date Posted --}}
                                        <div class="flex items-center ml-2 text-xs text-gray-500">
                                            <x-heroicon-o-clock class="w-4 h-4 mr-1" />
                                            Posted: {{ $post->created_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <h2 class="font-serif text-5xl font-bold mt-2">
                                        {{ $post->title() }}
                                    </h2>

                                </div>
                            </div>

                            <div class="mbp_thumb_post">
                                <div class="thumb mt30">
                                    <img class="w100"
                                        src="{{  asset('storage/' . $post->image()) }}"
                                        alt="{{ $post->title() }}">
                                </div>

                                <div class="leading-6 tracking-wide text-gray-700 mt-4">
                                    {!! $post->body() !!}
                                </div>

                                <hr class="mt50 mb40">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="flex flex-col items-center mb-24 space-y-4 blog_post_share">
                                            <h2 class="font-serif font-bold capitalize">Share this post</h2>

                                        {{-- social share --}}
                                            <x-social.links :post="$post" url="{{ Request::url() }}" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="mbp_pagination_tab">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="pag_prev">
                                            <div class="detls">
                                                <h5><span class="fa fa-angle-left mr5"></span> Previous Post</h5>
                                                <p> Given Set was without from god divide rule Hath</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="pag_next text-right">
                                            <div class="detls">
                                                <h5>Next Post <span class="fa fa-angle-right ml5"></span></h5>
                                                <p> Tree earth fowl given moveth deep lesser After</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="product_single_content mt-4">
                                {{-- comments --}}
                                    @if ($post->isCommentable())
                                    <x-posts.comments :model="$post" :type="$post->commentType()" />
                                    @endif
                            </div>

                        </div>
                    @endif
                </div>

                <x-sidenav.post :author="$post->writer->user()" :tags="$tags" :populars="$populars"/>

            </div>
        </div>
    </div>
</x-app-layout>

