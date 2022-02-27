<div>
    <div class="row">
        <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($carts['products']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($carts['products'] as $key => $product)
                                            <tr class="text-center font-bold text-sm">
                                                <td>
                                                    <div>
                                                        {{ $key+1 }}.
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <img src="{{ asset('storage/'. $product->firstImage()) }}"
                                                        width="50"
                                                        class="img img-circle"
                                                        alt="{{ $product->title()}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <p>{{ $product->title()}}</p>
                                                </td>
                                                <td>
                                                    <p>
                                                        {{ $product->vendor->name() }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <p>
                                                            {{ trans('global.naira') }} {{ $product->price() }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="#" wire:click="removeFromCart({{ $product->id }})">
                                                            <span class="fa fa-times"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center font-bold text-lg">
                                <span>
                                    You have no furnishing products.
                                </span>
                            </div>
                        @endif
                    </div>
                    @if(count($carts['products']) > 0)
                        <div class="col-md-12">
                            <div class="text-center font-bold text-lg uppercase p-2">
                                <h1>Order Summary</h1>
                            </div>

                            <x-box.order :model="$carts['products']" :total="$total" :sub="$subTotal" :ship="$shipping"/>
                        </div>
                    @endif
                </div>

        </div>

        <div class="col-md-4">
           <div class="row">
                <x-box.summary :model="$carts['products']" :total="$total" :sub="$subTotal" :ship="$shipping" :states="$states"/>
           </div>
        </div>
    </div>
</div>
