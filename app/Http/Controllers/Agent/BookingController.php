<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Models\Booking;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['agent', 'auth']);
    }

    public function index(Agent $agent)
    {        
        $bookings = Booking::where('agent_id',$agent->id)->get();

        return view('agent.booking',[
            'bookings' => $bookings
        ]);
    }

    public function show(Booking $booking)
    {
        //
    }

}
