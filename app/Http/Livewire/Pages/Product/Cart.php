<?php

namespace App\Http\Livewire\Pages\Product;

use App\Models\User;
use App\Models\State;
use Livewire\Component;
use App\Facades\Cart as cartFacade;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $carts;
    public $subTotal;
    public $shipping;
    public $total;
    public $states;

    public function mount(): void
    {
        $this->carts = cartFacade::get();
        $cartProductsIds = array_column($this->carts['products'], 'price');
        $price = array_sum($cartProductsIds);
        $this->subTotal = $price;
        $this->shipping = config('points.rewards.shipping');
        $this->total = $price + $this->shipping;
        $this->states = State::all();
    }

    public function render()
    {
        return view('livewire.pages.product.cart');
    }

    public function removeFromCart($productId): void
    {
        cartFacade::remove($productId);
        $this->carts = cartFacade::get();
        $this->emit('productRemoved');
    }

    public function checkout(): void
    {
        cartFacade::clear();
        $this->emit('clearCart');
        $this->carts = cartFacade::get();
    }
}
