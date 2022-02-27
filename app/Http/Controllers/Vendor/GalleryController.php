<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Gallery;
use App\Models\Category;
use App\Jobs\CreateGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Jobs\UpdateGallery;

class GalleryController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'vendor']);
    }

    
    public function create()
    {
        return view('vendor.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $this->dispatchSync(CreateGallery::fromRequest($request));

        $notification = array(
            'message' => 'Furniture created successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('vendor.gallery.edit',[
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $this->dispatchSync(UpdateGallery::fromRequest($gallery, $request));

        $notification = array(
            'message' => 'Gallery updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
