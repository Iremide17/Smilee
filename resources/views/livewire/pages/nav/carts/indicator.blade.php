<div>
    <li class="nav-item">
        @if ($hasCarts)
            <a class="nav-link cursor-pointer" href="{{ route('smilee.cart') }}" data-turbolinks-action="replace" title="Click to see the products in your cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <livewire:pages.nav.carts.count />
            </a>
        @endif
    </li>
</div>
