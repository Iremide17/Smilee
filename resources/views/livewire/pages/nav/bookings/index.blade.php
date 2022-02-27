<div>
    {{-- <x-alerts.loading/> --}}

    <li class="nav-item dropdown">
        @if ($hasBookings)
            <a class="nav-link" data-toggle="dropdown" href="#" title="Click to see lisite of your bookings">
                <i class="fa fa-home" aria-hidden="true"></i>
                <livewire:bookings.count />
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach ($bookings as $booking)
                    <div class="dropdown-item">
                        <div class="media">
                            <img src="{{ asset('storage/'.$booking->property->firstImage()) }}" alt="{{ $booking->property->name() }}" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $booking->property->agent->name() }}
                                    <span wire:click="removeFromBooking({{ $booking->id() }})" class="float-right text-sm text-danger"><i class="fa fa-times"></i></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>    
                @endforeach  
            <a href="{{  route('agent.properties.bookings', $booking->agent) }}" class="dropdown-item dropdown-footer">See all {{ Illuminate\Support\Str::plural('Booking', count($bookings)) }}.</a>                              
            </div>

        @endif
        
    </li>
</div>
