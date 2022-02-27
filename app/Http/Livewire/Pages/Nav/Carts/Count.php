<?php

namespace App\Http\Livewire\Pages\Nav\Carts;

use App\Facades\Cart;
use Livewire\Component;

class Count extends Component
{
    public $count;

    protected $listeners = [
        'cartBasket' => 'updateCount',
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount(): void
    {
        $this->count = count(Cart::get()['products']);
    }

    public function render()
    {
        return view('livewire.pages.nav.carts.count');
    }

    public function updateCartTotal(): void
    {
        $this->count = count(Cart::get()['products']);
    }
}
