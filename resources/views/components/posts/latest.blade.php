<div class="col-md-6 col-xl-3 transition duration-500 transform shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
    <div class="for_blog feat_property">
    <div class="thumb"> 
        <img class="img-whp" src="{{ asset('storage/'. $post->image()) }}" alt="{{ $post->title() }}">
        <div class="tag bgc-thm">
            @if ($post->tags())
                @foreach ($post->tags() as $tag)
                    <a class="text-white mr-1" href="#">{{ $tag->name() }}</a>
                @endforeach
            @endif
            
        </div>
        @if($post->isPremium())
                {{-- Premium Tag --}}
                <div class="absolute top-0 right-0">
                    <h2 class="p-2 text-xs text-gray-200 uppercase bg-gray-800">
                        Premium
                    </h2>
                </div>
        @endif
    </div>
    <div class="details">
        <div class="tc_content">
        <div class="bp_meta">
            <ul>
            <li class="list-inline-item"><a href="#"><span class="flaticon-user fz15 mr10"></span> {{ $post->writer->user()->name() }}</a></li>
            <li class="list-inline-item"><a href="#"><span class="flaticon-calendar fz15 mr10"></span> {{ $post->createdDate }}</a></li>
            </ul>
        </div>
        <h4>{{ $post->title() }}</h4>
        <p class="text-gray-900">{{ $post->excerpt(100) }}</p>
        <a class="text-thm tdu read_more_btn" href="{{ route('smilee.posts.show', $post)}}">READ MORE</a>
        </div>
    </div>
    </div>
</div>