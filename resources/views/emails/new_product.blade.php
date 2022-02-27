@component('mail::message')
**{{ $product->vendor->name() }}** has just created a new product

@component('mail::panel')
{{ $product->excerpt(200) }}
@endcomponent

@component('mail::button', ['url' => route('dashboard.products.show', ['category' => $product->category->slug(), 'product' => $product->slug()])])

View Product
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
