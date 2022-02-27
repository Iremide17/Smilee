<?php

namespace App\Http\Livewire\Pages\Nav\Bookings;

use App\Models\Booking;
use Livewire\Component;
use App\Policies\BookingPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;
    
    public $hasBookings;
    public $bookings;

    protected $listeners = [
        'book' => 'setHasBooking',
    ];

    public function render()
    {
        $this->hasBookings = Booking::where('status_id', 1)->where('agent_id', Auth::id())->count();
        $this->bookings =  Booking::all();

        return view('livewire.pages.nav.bookings.index', [
            'hasBookings' => $this->hasBookings,
            'bookings' => $this->bookings,
        ]);
    }

    public function removeFromBooking($bookingId)
    {
        
        $booking = Booking::findOrFail($bookingId);
        $this->authorize(BookingPolicy::ACTION, $booking);
        $booking->delete();

        $this->emit('book', booking::where('author_id',Auth::id())->count());

        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Property has been removed from your booking',
        ]);

        $this->mount();
    }

    public function setHasBooking(int $count): bool
    {
        return $count > 0;
    }
}
