<div class="checkout-page">
    <div class="billing-details">
        <div class="shop-form">
            @if(count($carts['products']) > 0)
                <x-form action="{{ route('smilee.order.store') }}">
                    
                    <input type="hidden" id="total" name="total" value="{{ $total }}">
                    <input type="hidden" id="email" name="email" value="{{ auth()->user()->emailAddress() }}">
                    <input type="hidden" id="payment_type" name="payment_type" value="{{ $paymentType }}">

                    @foreach ($carts['products'] as $key => $product)

                        <input type="hidden" name="vendor_id[]" value="{{ $product->vendor_id }}">

                        <input type="hidden" name="product_id[]" value="{{ $product->id}}">

                        <input type="hidden" name="price[]" class="form-control price" value="{{ $product->price }}">

                    @endforeach

                    <div class="row clearfix">
                        <div class="col-md-5 col-md-12 col-sm-12">
                            <div class="sec-title"><h2>Your Order</h2></div>
                            <div class="shop-order-box">
                                <ul class="order-list">
                                    <li>Product<span>TOTAL</span></li>
                                    @foreach ($carts['products'] as $product)
                                        <li>{{ $product->title() }}<span>{{ trans('global.naira') }} {{ number_format($product->price(), 2, ',', '.') ?? ''}}</span></li>
                                    @endforeach
                                    <li>Subtotal<span class="dark">{{ trans('global.naira') }}{{ number_format($subTotal, 2, ',', '.') ?? ''}}</span></li>
                                    <li>Shipping And Handling<span>{{ trans('global.naira') }}{{ number_format($shipping, 2, ',', '.') ?? ''}}</span></li>
                                    <li class="total">TOTAL<span class="dark">{{ trans('global.naira') }}{{ number_format($total, 2, ',', '.') ?? ''}}</span></li>
                                </ul>


                                <!--Place Order-->
                                <div class="place-order">
                                    <x-buttons.primary>
                                        <span class="txt">Place Order</span>
                                    </x-buttons.primary>
                                </div>
                                <!--End Place Order-->

                            </div>


                        </div>
                    </div>
                </x-form>
            @else
                You have no product in your cart. Please visit the shopping page to add products
            @endif
        </div>

    </div>
</div>