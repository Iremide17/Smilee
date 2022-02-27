@component('mail::message')
**{{ $booking->author()->name() }}** has just booked your property **{{ $booking->property->name() }}**

@component('mail::panel')
<img src="{{ asset('storage/' .$booking->property->firstImage()) }}" alt="{{ $booking->property->name() }}">
@endcomponent

@component('mail::button', ['url' => route('agent.index', auth()->user()->agent)])

View property
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
