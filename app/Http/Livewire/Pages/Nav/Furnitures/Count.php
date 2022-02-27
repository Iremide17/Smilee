<?php

namespace App\Http\Livewire\Pages\Nav\Furnitures;

use Livewire\Component;
use App\Facades\Furnish;
use Illuminate\View\View;

class Count extends Component
{
    public $count;

    protected $listeners = [
        'furnishBasket' => 'updateCount',
    ];

    public function render(): View
    {
        $this->count = count(Furnish::get()['furnitures']);

        return view('livewire.pages.nav.furnitures.count',[
            'count' => $this->count,
        ]);
    }

    public function updateCount(int $count): int
    {
        return $count;
    }
}
