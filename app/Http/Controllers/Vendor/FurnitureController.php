<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Category;
use App\Models\Furniture;
use Illuminate\Http\Request;
use App\Jobs\CreateFurniture;
use App\Jobs\UpdateFurniture;
use App\Http\Controllers\Controller;
use App\Http\Requests\FurnitureRequest;

class FurnitureController extends Controller
{
    
    public function __construct()
    {
        return $this->middleware(['auth', 'vendor']);
    }
    
    public function index()
    {
        //
    }

   
    public function create()
    {
        return view('vendor.furniture.create',[
            'categories' => Category::all(),
        ]);
    }

    
    public function store(FurnitureRequest $request)
    {
        $this->dispatchSync(CreateFurniture::fromRequest($request));

        $notification = array(
            'message' => 'Furniture created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function show(Furniture $furniture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function edit(Furniture $furniture)
    {
        return view('vendors.furniture.edit',[
            'furniture' => $furniture,
            'categories' => Category::all(),
            'selectedTags'  => old('tags', $furniture->categories()->pluck('id')->toArray()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(furnitureRequest $request, Furniture $furniture)
    {
        $this->dispatchSync(UpdateFurniture::fromRequest($furniture, $request));

        $notification = array(
            'message' => 'Furniture updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Furniture $furniture)
    {
        //
    }
}
