<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
       return $this->middleware(['agent', 'auth']);
    }

    public function index()
    {
        $agent = Agent::where('id', Auth::user()->agent->id())->first();
        
        $bookings = Booking::where('agent_id',$agent->id)->get();

        return view('agent.index',[
            'bookings' => $bookings
        ]);
    }
}
