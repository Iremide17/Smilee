<?php

namespace App\Http\Controllers\Pages;

use App\Models\Furniture;
use App\Http\Controllers\Controller;
use App\Models\Vendor;

class FurnitureController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.furniture.index');
    }

    public function show(Furniture $furniture)
    {
        return view('pages.furniture.show',[
            'furniture' => $furniture
        ]);
    }

    public function edit(Furniture $furniture)
    {
        return view('pages.furniture.edit',[
            'furniture' => $furniture
        ]);
    }

    public function furniture(Vendor $vendor, Furniture $furniture)
    {
        return view('pages.vendor.show', [
            'vendor'       => $vendor,
            'furniture'       => $furniture,
        ]);
    }

}
