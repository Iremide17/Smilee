<?php

namespace App\Http\Livewire\Pages\Product;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;

class Carting extends Component
{
    public $product;
     
    public function mount(Product $product)
    {
        $this->product = $product;
    }
    
    public function addToCart(int $productId): void
    {
            Cart::add(Product::where('id', $productId)->first());
            $this->emit('productAdded');
            $this->dispatchBrowserEvent('alert', [
                'message'     => 'Product added to cart successfully',
            ]);
    }
    
    public function render()
    {
        return view('livewire.pages.product.carting');
    }
}
