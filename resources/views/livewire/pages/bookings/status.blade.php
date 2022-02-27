<div class="btn-group">
    <x-alerts.loading/>

    <button type="button" class="{{ $booking->status_btn }}  btn">Action</button>
    <button type="button" class=" {{ $booking->status_btn }} btn dropdown-toggle dropdown-icon" data-toggle="dropdown">
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" role="menu">


        @if ($booking->status_id == 1)

            @can(App\Policies\BookingPolicy::DELETE, $booking)
                <a class="dropdown-item" href="#">
                    <span wire:click.prevent="delete({{ $booking->id() }})" class="text-red-600">
                        <i class="fa fa-times" aria-hidden="true"></i> delete booking
                    </span>
                </a>
            @endcan

            @can(App\Policies\BookingPolicy::ACTION, $booking)
                <a class="dropdown-item" href="#">
                    <span wire:click.prevent="accept({{ $booking->id() }})" class="text-green-600">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Accept booking
                    </span>
                </a>
            @endcan

            @can(App\Policies\BookingPolicy::ACTION, $booking)
                <a class="dropdown-item" href="#">
                    <span wire:click.prevent="reject({{ $booking->id() }})" class="text-blue-600">
                        <i class="fa fa-times-circle" aria-hidden="true"></i> Reject booking
                    </span>
                </a>
            @endcan

        @elseif ($booking->status_id == 3)
            @can(App\Policies\BookingPolicy::VERIFY, $booking)

                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" role="form">
                    @csrf

                    <input type="hidden" name="email" value="{{ auth()->user()->emailAddress() }}"> {{-- required --}}
                    <input type="hidden" name="orderID" value="345">
                    <input type="hidden" name="amount" value="{{ $booking->property->price() }}00"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="currency" value="NGN">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = [
                        'paymentable_type' => 'properties',
                        'payment_type' => 'paystack',
                        'user_id' => auth()->id(),
                        'booking' => $booking
                        ]) }}" >
                    {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> required --}}
                    <input type="hidden" name="split_code" value="SPL_tV5ByW7Qlg">
                    <input type="hidden" name="split" value="{{ json_encode($split) }}">

                    <div class="justify-center">
                        <x-buttons.default>
                            <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                        </x-buttons.default>
                    </div>
                </form>

            @endcan


        {{-- <a class="dropdown-item" href="#">
            <span wire:click.prevent="verified({{ $booking->id() }})" class="text-green-600">
                <i class="fa fa-check-circle" aria-hidden="true"></i> Verify
            </span>
        </a> --}}

        @elseif ($booking->status_id == 4)

            @can(App\Policies\BookingPolicy::ACTION, $booking)
                <a class="dropdown-item" href="#">
                    <span wire:click.prevent="delete({{ $booking->id() }})" class="text-red-400">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete booking
                    </span>
                </a>
            @endcan

        @elseif ($booking->status_id == 5)
            <P>  Your booking was declined by the agent </p>
        @endif
    </div>
</div>

