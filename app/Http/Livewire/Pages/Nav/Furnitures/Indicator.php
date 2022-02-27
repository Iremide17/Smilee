<?php

namespace App\Http\Livewire\Pages\Nav\Furnitures;

use App\Facades\Furnish;
use Livewire\Component;

class Indicator extends Component
{
    public $hasFurnishs;

    protected $listeners = [
        'furnishBasket' => 'setHasFurnish',
    ];

    public function mount(): void
    {
        $this->hasFurnishs = Furnish::get();
    }

    public function render()
    {
        return view('livewire.pages.nav.furnitures.indicator',[
            'hasFurnishs' => $this->setHasFurnish(
                count(Furnish::get()['furnitures'])
            ),
        ]);
    }

    public function removeFromFurnish($id)
    {
        Furnish::remove($id);
        $this->emit('furnishBasket', count(Furnish::get()['furnitures']));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Furniture removed from cart',
        ]);
        $this->reset();
    }

    public function setHasFurnish(int $count): bool
    {
        return $count > 0;
    }
}
