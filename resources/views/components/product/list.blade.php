<div class="single-product-item col-md-6 col-xl-3 transition duration-500 transform shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
    <div class="img-holder">
        <a href="{{ route('smilee.products.show', $product) }}">
            <img width="270" height="200" src="{{ asset('storage/'.$product->firstImage())}}" class="" alt="">
        </a>
        @if($product->isNew())
                {{-- new type --}}
            <div class="absolute top-0 right-0">
                <h2 class="p-2 text-xs text-gray-200 uppercase bg-gray-800">
                    New
                </h2>
            </div>
        @endif
    </div>
    <div class="text-center title-holder">
        <div class="static-content">
            <h3 class="text-center title">
                <a href="{{ route('smilee.products.show', $product) }}">{{ $product->title() }}</a></h3>
            <span class="price">
                <span class="amount">
                    <span class="">{{ trans('global.naira') }}</span>
                    {{ number_format($product->price(), 2, ',', '.') ?? ''}}
                </span>
            </span>
        </div>
        <div class="overlay-content">
            <ul class="clearfix">
                <livewire:pages.product.carting :product="$product" :key="$product->id()">  
            </ul>
        </div>

    </div>
</div>