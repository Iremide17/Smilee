<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-50">
            {{ __('Bookings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200">
                <section class="cart-section">
                    @if (!$bookings->isEmpty())
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        @if (count($bookings) > 0)
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Price</th>
                                                <th>Agent</th>
                                                <th>Duration</th>
                                                <th></th>
                                            </tr>
                                        @endif
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <img src="{{ asset('storage/'. $booking->property->firstImage()) }}"
                                                            width="50"
                                                            class="img img-circle"
                                                            alt="{{ $booking->property->name()}}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                            <p>{{ $booking->property->name()}}</p>
                                                    </td>
                                                    <td>
                                                        <p>{{ trans('global.naira') }} {{ number_format($booking->property->price(), 2) }}</p>
                                                    </td>
                                                    <td>

                                                        <p>
                                                            {{ $booking->property->agent->name() }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        @if ($booking->status_id == 4)
                                                            <p>
                                                                <span>{{  $booking->startAtDate() }}</span> - <span>{{ $booking->endAtDate() }}</span>
                                                            </p>
                                                        @else
                                                            @if ($booking->property->type == 'rent')
                                                                <livewire:pages.bookings.update :booking="$booking" :key="$booking->id()">
                                                            @else
                                                                <span class="font-bold text-lg text-center"> - </span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p class="btn {{ $booking->status_btn }}">
                                                            Booking {{ $booking->status->name() }}
                                                            @if ($booking->status_id == 3)
                                                                 <span>| Update your duration and pay</span>
                                                            @endif
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <livewire:pages.bookings.status :booking='$booking' :page="request()->fullUrl()" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                You have no booking.
                            @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

