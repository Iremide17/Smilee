@component('mail::message')
A new payment has just been made by **{{ $payment->author()->name() }}** with reference id =  **{{ $payment->referenceId() }}**

@component('mail::panel')

**Amount:** {{ trans('global.naira') }} {{ $payment->amount() }} <br>
**Transaction email:** {{ $payment->email() }} <br>
**Status:** 
@if ($payment->status_id == 1) <span class="text-danger">Unconfirmed</span> @else Confirmed @endif 
@endcomponent

@component('mail::button', ['url' => route('payments.show', $payment)])

View payment
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
