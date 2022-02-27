<?php

namespace App\Http\Livewire\Pages\Bookings;

use App\Models\Booking;
use Livewire\Component;

class Update extends Component
{
    public $booking;

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
    }
    
    public function setDuration($booking, $duration)
    {
        $book = Booking::findOrFail($booking['id']);
        $book->update(['duration' => $duration]);
        $this->dispatchBrowserEvent('alert', ['message' => 'Duration updated successfully!']);
    }

    public function render()
    {
        return view('livewire.pages.bookings.update');
    }
}
