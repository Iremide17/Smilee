@component('mail::message')
**vendor {{  $detail->vendor->name() }}  there is a new order in your dashboard!

@component('mail::panel')
{{ $detail->order->author()->name() }}** has requested to buy your product {{ $detail->product->title() }}! 
**Please visit your dashboard to view the order.
@endcomponent

@component('mail::button', ['url' => route('smilee.order.index', $detail->vendor->slug() )])
<i class="fa fa-eye" aria-hidden="true"></i> View Order
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
