@component('mail::message')
**{{ $booking->author()->name() }}** has just verified your property {{ $booking->property->name() }}.
Thanks for using {{ application('name') }} application. We hope it has made you smile!

@component('mail::panel')
**This verification has earned you 20 points! Current Point = **{{ $booking->author()->currentPoints() }}**
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
