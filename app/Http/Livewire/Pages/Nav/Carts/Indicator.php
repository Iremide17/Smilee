<?php

namespace App\Http\Livewire\Pages\Nav\Carts;

use App\Facades\Cart;
use Livewire\Component;

class Indicator extends Component
{
    public $hasCarts;

    protected $listeners = [
        'cartBasket' => 'setHasCart',
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount(): void
    {
        $this->hasCarts = count(Cart::get()['products']);
    }

    public function render()
    {
        return view('livewire.pages.nav.carts.indicator');
    }

    public function setHasCart(int $count): bool
    {
        return $count > 0;
    }
        
    public function updateCartTotal(): void
    {
        $this->hasCarts = count(Cart::get()['products']);
    }
}
