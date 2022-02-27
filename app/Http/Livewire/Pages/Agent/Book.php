<?php

namespace App\Http\Livewire\Pages\Agent;

use App\Models\Status;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Property;
use App\Events\BookingWasCreated;
use Illuminate\Support\Facades\Auth;

class Book extends Component
{
    public $property;
    public $showModal = false;

    protected $listeners = [
        'book' => 'setHasBooking',
    ];

    public function bookProperty()
    {
        $this->dispatchBrowserEvent('show-form');
    }
    

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    public function book()
    {
        $check = Booking::where('author_id',Auth::id())->where('property_id',$this->property->id())->first();

        if ($check) {
            $this->dispatchBrowserEvent('error', [
                'message'     => 'Sorry! property ' .$this->property->name(). ' has already been booked. Please wait for confirmation from the agent or administrator',
            ]);
        }
        else{

            $status = Status::whereName('Pending')->first();

            $booking = new Booking();
            $booking->authoredBy(Auth::user());
            $booking->property()->associate($this->property);
            $booking->agent()->associate($this->property->agent_id);
            $booking->status()->associate($status); 
            // $booking->start_at = now();
            // $booking->end_at = now();
            $booking->save();

            event(new BookingWasCreated($booking));

            $this->dispatchBrowserEvent('alert', [
                'message'     => 'Property booked successfully',
            ]);

            $this->emit('book', booking::where('author_id',Auth::id())->count());

        }        
    }

    public function setHasBooking(int $count): bool
    {
        return $count > 0;
    }

    public function render()
    {
        return view('livewire.pages.agent.book');
    }
}
