<div class="px-2 py-1 text-xs text-gray-500 transition duration-100 rounded">
    
    <x-alerts.loading/>

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#payment{{ $model->id}}">
        <i class="fa fa-credit-card" aria-hidden="true"></i> Order
    </button>

    <div class="modal fade" id="payment{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="p-5">
                    <div class="flex flex-row space-x-8 justify-center">
                        <div class="flex flex-col">
                            <div>
                                <img src="{{ asset('default.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover">
                            </div>
                            <div>
                                <h1 class="p-2">You can pay when the goods are delivered</h1>

                                <x-form action="{{ route('smilee.order.store') }}">

                                    <input type="text" id="total" name="total" value="{{ $model->price()}}">
                                    <input type="text" id="payment" name="payment" value="pod">
                                    <input type="text" id="orderable_id" name="orderable_id" value="{{ $model->id() }}">
                                    <input type="text" id="orderable_type" name="orderable_type" value="{{ class_basename($model) }}">

                                    <x-buttons.custom type="submit">
                                        #PayOnDelivery
                                    </x-buttons.custom>
                                </x-form>
                            </div>
                        </div>
        
                        <div class="flex flex-col">
                            <div>
                                <img src="{{ asset('mastercard.png') }}" alt="default image" class="rounded-full h-20 w-20 object-cover">
                            </div>
                            <div>
                                <h1 class="p-2">Pay with Paystack</h1>

                                <x-form action="">
                                    <x-buttons.custom>
                                        #Paystack
                                    </x-buttons.custom>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
