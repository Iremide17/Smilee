<div class="col-md-12">
    <div class="checkout-page">
        <div class="billing-details">
            <div class="shop-form">
                <div class="shop-order-box">
                    <div class="place-order">
                        <div class="payment-options">
                            <ul>
                                <li>
                                    <div class="radio-option">
                                        
                                        <input type="radio" name="payment_type" id="payment-2" value="pod">

                                        <label for="payment-2"><strong>Pay on Delivery</strong>
                                            <span class="small-text">

                                                <div class="place-order">

                                                    <form action="{{ route('smilee.order.store') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" id="total" name="total" value="{{ $total }}">
                                                        <input type="hidden" id="payment" name="payment" value="pod">

                                                        <div class="mt-2">
                                                            <div class="text-center font-bold uppercase mb-2">
                                                                <h2>Billing Details</h2>
                                                            </div>
                                                            
                                                            <div class="row">
    
                                                                <div class="col-md-12 mb-1">
                                                                    <x-form.label for="address" value="{{ __('Address') }}" />
                                                                    <x-form.input id="address" class="block w-full mt-1" type="text" name="address" :value="old('address')"/>
                                                                    <x-form.error for="address" />
                                                                </div>
    
                                                                
                                                                <div class="col-md-12 mb-1">
                                                                    <x-form.label for="city" value="{{ __('City') }}" />
                                                                    <x-form.input id="city" class="block w-full mt-1" type="text" name="city" :value="old('city')"/>
                                                                    <x-form.error for="city" />
                                                                </div>
    
                                                                
                                                                <div class="col-md-12 mb-1">
                                                                    <x-form.label for="state" value="{{ __('State') }}" />
                                                                    <select name="state" id="state" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                                        <option value="select">Select</option>
                                                                        @foreach ($states as $state)
                                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <x-form.error for="state" />
                                                                </div>
    
                                                                
                                                                <div class="form-group col-md-12">
                                                                    <x-form.label for="phone" value="{{ __('Phone Number') }}" />
                                                                    <x-form.input id="phone" class="block w-full mt-1" type="tel" name="phone" :value="old('phone')"/>
                                                                    <x-form.error for="phone" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                    
                                                        @foreach ($model as $key => $item)
                                                            <input type="hidden" name="vendor_id[]" value="{{ $item->vendor_id }}">
                                                            <input type="hidden" name="item_id[]" value="{{ $item->id}}">
                                                            <input type="hidden" name="price[]" class="form-control" value="{{ $item->price }}">
                                                        @endforeach

                                                        <div class="row">
                                                            <div class="justify-center">
                                                                <x-buttons.custom>
                                                                    <span class="txt">Make Order</span>
                                                                </x-buttons.custom>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </span>
                                        </label>

                                    </div>
                                </li>
                                <li>
                                    <div class="radio-option">

                                        <input type="radio" name="payment_type" id="payment-3" checked="" value="paystack">

                                        <label for="payment-3"><strong>PayStack</strong>
                                            <span class="small-text">
                                                <div class="col-md-12">
                                                    <div class="ml-4">
                                                        <x-buttons.custom>
                                                            Pay with Paystack
                                                        </x-buttons.custom>
                                                    </div>
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="radio-option">

                                        <input type="radio" name="payment_type" id="payment-3" value="loan">

                                        <label for="payment-3"><strong>Pay on Loan</strong>
                                            <span class="small-text">
                                                <div class="col-md-12">
                                                    <div class="ml-4">
                                                        <x-buttons.custom>
                                                            Pay on Loan
                                                        </x-buttons.custom>
                                                    </div>
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>