<?php

namespace App\Http\Livewire\Pages\Vendor;

use App\Facades\Furnish;
use Livewire\Component;
use App\Models\Furniture as modelFur;

class Furniture extends Component
{
    public $furniture;
    public $confirmFurniturePurchase = false;

    public function mount(modelFur $furniture)
    {
        $this->furniture = $furniture;
    }

    public function confirmPurchhase()
    {
        $this->resetErrorBag();
        $this->confirmFurniturePurchase = true;
    }

    public function purchaseFurniture()
    {
        Furnish::add(modelFur::where('id', $this->furniture->id())->first());
        $this->emit('furnishBasket', count(Furnish::get()['furnitures']));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Furniture added to furnish successfully',
        ]);
        $this->confirmFurniturePurchase = false;
    }

    public function render()
    {
        return view('livewire.pages.vendor.furniture');
    }
}
