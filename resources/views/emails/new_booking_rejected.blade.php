@component('mail::message')
**{{ $booking->agent->name() }}** has just rejected your booking

@component('mail::panel')
If you have any complain about the agent, please call our
customer care line on <a href="tel:+{{ application('line1') }}"></a> or email us at <a href="mailto:{{ application('email') }}"></a>

<img src="{{ asset('storage/' .$booking->property->firstImage()) }}" alt="{{ $booking->property->name() }}">

**Note: ** {{ application('name') }} does not negotiate price for you. We only bring you closer to the agents.

@endcomponent

@component('mail::button', ['url' => route('agents.properties.show', $booking->property->slug())])

View property
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
