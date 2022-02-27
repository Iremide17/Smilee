<?php

namespace App\Http\Controllers\Pages;

use App\Models\Property;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.property.index');
    }


    public function show(Property $property)
    {
        return view('pages.property.show',[
            'property' => $property
        ]);
    }
}
