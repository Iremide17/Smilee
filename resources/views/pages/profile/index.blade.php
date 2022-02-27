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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Agent</th>
                                                <th>Status</th>            
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
                                                        <p>
                                                            {{ $booking->property->agent->name() }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="btn {{ $booking->status_btn }}">
                                                            {{ $booking->status->name() }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <livewire:bookings.status :booking='$booking' :page="request()->fullUrl()" />
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

