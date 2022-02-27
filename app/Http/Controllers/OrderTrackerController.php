<?php

namespace App\Http\Controllers;

use App\Models\OrderTracker;
use App\Http\Requests\StoreOrderTrackerRequest;
use App\Http\Requests\UpdateOrderTrackerRequest;

class OrderTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderTrackerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderTrackerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderTracker  $orderTracker
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTracker $orderTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderTracker  $orderTracker
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTracker $orderTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderTrackerRequest  $request
     * @param  \App\Models\OrderTracker  $orderTracker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderTrackerRequest $request, OrderTracker $orderTracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderTracker  $orderTracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTracker $orderTracker)
    {
        //
    }
}
