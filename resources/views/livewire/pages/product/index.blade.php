<div class="container">
    <div class="row">
        <div class="col-md-2">
            <x-alerts.search :types="$types" :categories="$categories" :prices="$prices"/>
        </div>
        
        <div class="col-md-10">
            <div class="clearfix row">
                @forelse($products as $product)
                    <x-product.list :product="$product"/>
                @empty
                    <p>No products available</p>
                @endforelse
            </div>
         
             <x-alerts.loadmore :models="$products"/>
        </div>
    </div>
 </div>
