@component('mail::message')
**{{ $gallery->vendor->name() }}** has just posted a new photo

@component('mail::panel')
{{ $gallery->excerpt(200) }}
@endcomponent

@component('mail::button', ['url' => route('dashboard.vendors.show', $gallery->vendor->slug())])

View Vendor
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
