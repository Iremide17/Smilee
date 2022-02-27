<?php

namespace App\Http\Livewire\Pages\Furnitures;

use App\Models\State;
use Livewire\Component;
use App\Facades\Furnish as facadeFurnish;

class Furnish extends Component
{

    public $furnishs;
    public $subTotal;
    public $shipping;
    public $total;
    public $states;

    public function mount(): void
    {
        $this->furnishs = facadeFurnish::get('furnitures');

        $furnishFurnituresIds = array_column($this->furnishs['furnitures'], 'price');
        $price = array_sum($furnishFurnituresIds);
        $this->subTotal = $price;
        $this->shipping = config('points.rewards.shipping');
        $this->total = $price + $this->shipping;
        $this->states = State::all();
    }

    public function removeFromCart($furnitureId): void
    {
        facadeFurnish::remove($furnitureId);
        $this->carts = facadeFurnish::get();
        $this->emit('furnitureRemoved');
    }

    public function render()
    {
        return view('livewire.pages.furnitures.furnish');
    }
}
