<?php

namespace App\Http\Livewire\Pages\Bookings;

use App\Models\Booking;
use Livewire\Component;
use App\Policies\BookingPolicy;
use App\Events\BookingWasAccepted;
use App\Events\BookingWasRejected;
use App\Events\BookingWasVerified;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Status extends Component
{

    use AuthorizesRequests;

    public $booking;
    public $page;

    public function mount(Booking $booking, $page)
    {
        $this->booking = $booking;
        $this->page = $page;
    }

    public function accept(Booking $booking)
    {
        $this->authorize(BookingPolicy::ACTION, $booking);
        $booking->update(['status_id' => 3]);
        event(new BookingWasAccepted($booking));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Booking accepted successfully',
        ]);
        return redirect()->to($this->page);
    }

    public function reject(Booking $booking)
    {
        $this->authorize(BookingPolicy::REJECT, $booking);
        $booking->update(['status_id' => 5]);
        event(new BookingWasRejected($booking));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Booking rejected successfully',
        ]);
        return redirect()->to($this->page);
    }

    public function verified(Booking $booking)
    {
        $this->authorize(BookingPolicy::VERIFY, $booking);
        $booking->update(['status_id' => 4]);
        event(new BookingWasVerified($booking));
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Booking verified successfully',
        ]);
        return redirect()->to($this->page);
    }

    public function delete(Booking $booking)
    {
        $this->authorize(BookingPolicy::DELETE, $booking);
        $booking->delete();
        $this->dispatchBrowserEvent('alert', [
            'message'     => 'Booking deleted successfully',
        ]);
        return redirect()->to($this->page);
    }

    public function render()
    {
        $split = [
            "type" => "percentage",
            "currency" => "NGN",
            "subaccounts" => [
             [ "subaccount" => "ACCT_0vpsncxygq3d5y1", "share" => 10 ],
            ],
            "bearer_type" => "all",
            "main_account_share" => 90
         ];

        return view('livewire.pages.bookings.status',[
            'split' => $split
        ]);
    }
}
