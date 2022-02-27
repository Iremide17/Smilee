<div class="checkout-page">
    <div class="billing-details">
        <div class="shop-form">
            @if(count($carts['products']) > 0)
                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                    @csrf

                    <input type="hidden" id="payment_type" name="payment_type" value="{{ $paymentType }}">
                    <input type="hidden" name="email" value="{{ auth()->user()->emailAddress() }}"> {{-- required --}}
                    <input type="hidden" name="orderID" value="345">
                    <input type="hidden" name="amount" value="{{ $total }}00"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="currency" value="NGN">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = [
                        'paymentable_type' => 'products',
                        'payment_type' => $paymentType,
                        'cartItems' => $carts['products'],
                        'user_id' => auth()->id(),
                        ]) }}" >
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <input type="hidden" name="split_code" value="SPL_tV5ByW7Qlg">
                    <input type="hidden" name="split" value="{{ json_encode($split) }}">

                    <div class="row clearfix">

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="sec-title"><h2>Your Order</h2></div>
                            <div class="shop-order-box">
                                <ul class="order-list">
                                    <li>Product<span>TOTAL</span></li>
                                    @foreach ($carts['products'] as $product)
                                        <li>{{ $product->title() }}<span>{{ trans('global.naira') }} {{ number_format($product->price, 2, ',', '.') ?? ''}}</span></li>
                                    @endforeach
                                    <li>Subtotal<span class="dark">{{ trans('global.naira') }}{{ number_format($subTotal, 2, ',', '.') ?? ''}}</span></li>
                                    <li>Shipping And Handling<span>{{ trans('global.naira') }}{{ number_format($shipping, 2, ',', '.') ?? ''}}</span></li>
                                    <li class="total">TOTAL<span class="dark">{{ trans('global.naira') }}{{ number_format($total, 2, ',', '.') ?? ''}}</span></li>
                                </ul>


                                <!--Place Order-->
                                <div class="d-block">
                                    <x-buttons.primary class="form_nav_actions m-auto">
                                        <span class="txt">
                                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                                        </span>
                                    </x-buttons.primary>
                                </div>
                                <!--End Place Order-->

                            </div>


                        </div>
                    </div>
                </form>
            @else
                You have no product in your cart. Please visit the shopping page to add products
            @endif
        </div>

    </div>
</div>


