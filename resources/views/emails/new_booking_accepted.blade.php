@component('mail::message')
**{{ $booking->agent->name() }}** has just accepted your booking

@component('mail::panel')
You can proceed to make payment on your dashboard by clicking the pay now button in the **action** dropdown. If you have any complain about the property please call {{ application('name') }} 
customer care line on <a href="tel:+{{ application('line1') }}"></a> or email us at <a href="mailto:{{ application('email') }}"></a>
@endcomponent

@component('mail::button', ['url' => route('booking', auth()->user()->username())])
Goto Booking
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
