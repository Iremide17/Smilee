<?php

namespace App\Http\Livewire\Pages\Nav\Bookings;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Count extends Component
{
    public $count;

    protected $listeners = [
        'book' => 'updateCount',
    ];

    public function render(): View
    {
        $this->count = Booking::where('status_id', 1)->where('agent_id', Auth::id())->count();

        return view('livewire.pages.nav.bookings.count', [
            'count' => $this->count,
        ]);
    }

    public function updateCount(int $count): int
    {
        return $count;
    }
}
