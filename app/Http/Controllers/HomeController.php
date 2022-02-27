<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Category;

class HomeController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:sanctum', 'verified']);
    }
    
    public function index()
    {
        // $categories = Category::all();
        // $vendors = Vendor::search()
        //     ->paginate(6);

        // $mapVendors = $vendors->makeHidden(['slug', 'created_at', 'updated_at', 'banner', 'image', 'phone', 'email', 'instagram', 'facebook']);
        // $latitude = $vendors->count() && (request()->filled('category') || request()->filled('search')) ? $vendors->average('latitude') : 11.798;
        // $longitude = $vendors->count() && (request()->filled('category') || request()->filled('search')) ? $vendors->average('longitude') : 13.125;

        return view('dashboard');
    }
}
