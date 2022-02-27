<div>
    <li class="nav-item dropdown">
        @if ($hasCart)
            <a class="nav-link cursor-pointer" data-toggle="dropdown" href="#" title="Click to see the products in your cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <livewire:carts.count />
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">           
                    You have {{ count($carts) }} {{ Illuminate\Support\Str::plural('product', count($carts)) }} in your cart!
                </span>
                <div class="dropdown-divider"></div>
                    @foreach ($carts as $cart)
                        <div class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('storage/'.$cart->product->image()) }}" alt="{{ $cart->product->title() }}" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ $cart->product->title() }}
                                        <span wire:click="removeFromCart({{ $cart->id() }})" class="float-right text-sm text-danger cursor-pointer"><i class="fa fa-times"></i></span>
                                    </h3>
                            </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>    
                    @endforeach
                <a href="{{  route('cart', auth()->user()->username) }}" class="dropdown-item dropdown-footer">See all {{ Illuminate\Support\Str::plural('product', count($carts)) }} in your cart.</a>                
            </div>
        @endif
    </li>
</div>
