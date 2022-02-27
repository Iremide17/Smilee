<div>
    <li>
        <a href="#" wire:click.prevent="addToCart({{ $product->id }})">
            <span class="fa fa-heart"></span>
            <div class="toltip-content">
                <p>Add to Cart</p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ route('smilee.vendors.show',$product->vendor->slug()) }}" x-ref="productLink" class="">
            <span class="fa fa-eye"></span>
            <div class="toltip-content">
                <p>Vendor Profile</p>
            </div>
        </a>
    </li>
    <li>
        <a href="{{ asset('storage/'.$product->firstImage())}}" class="lightbox-image" data-fancybox="shop-gallery">
            <span class="fa fa-expand"></span>
            <div class="toltip-content">
                <p>Zoom In</p>
            </div>
        </a>
    </li>
</div>
