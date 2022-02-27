<?php

namespace App\Http\Controllers\Pages;

use App\Models\Cart;
use App\Models\User;
use App\Models\Booking;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Jobs\UpdateUserAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressStoreRequest;
use App\Models\BillingAddress;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.profile.show',[
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function cart(): View
    {

        return view('pages.profile.cart');
    }

    public function checkout(User $user, AddressStoreRequest $request): View
    {
        $billingAddress = BillingAddress::findOrFail($request->billable);
        $this->dispatchSync(UpdateUserAddress::fromRequest($billingAddress, $request));

        if ($request->payment_type == 'paystack')
        {
            return view('pages.profile.paystack',[
                'type' => $request->payment_type,
                'user' => $user,
            ]);
        }
        elseif($request->payment_type == 'pod')
        {
            return view('pages.profile.pod',[
                'type' => $request->payment_type,
                'user' => $user,
            ]);
        }
    }

    public function booking(User $user): View
    {
        return view('pages.profile.booking',[

            'user' => $user,
            'bookings' => Booking::all(),
        ]);
    }

    public function furnish()
    {
        return view('pages.profile.furnish');
    }
}
