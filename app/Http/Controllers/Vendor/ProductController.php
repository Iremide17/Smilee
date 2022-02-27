<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Product;
use App\Models\Category;
use App\Jobs\CreateProduct;
use App\Jobs\DeleteProduct;
use App\Jobs\UpdateProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'vendor']);
    }
   
    public function create()
    {
        return view('vendors.product.create',[
            'categories' => Category::all(),
        ]);
    }

    
    public function store(ProductRequest $request)
    {
        $this->dispatchSync(CreateProduct::fromRequest($request));

        $notification = array(
            'message' => 'Product Created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('vendors.product.edit',[
            'product' => $product,
            'categories' => Category::all(),
            'selectedTags'  => old('tags', $product->categories()->pluck('id')->toArray()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->dispatchSync(UpdateProduct::fromRequest($product, $request));

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type'    => 'success'
        );
        
        return redirect()->route('vendor.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->dispatchSync(new DeleteProduct($product));

         $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
