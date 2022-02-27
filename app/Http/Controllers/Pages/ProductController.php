<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.product.index');
    }


    public function show(Product $product)
    {
        $related = Product::where('vendor_id', $product->vendor_id)->inRandomOrder()->get();
        return view('pages.product.show',[
            'product' => $product,
            'related' => $related
        ]);
    }
}
