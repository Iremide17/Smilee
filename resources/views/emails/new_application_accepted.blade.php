@component('mail::message')
**Hello User {{ $agent->user()->name() }}!

@component('mail::panel')
{{ application('name') }}({{ application('alias') }}) would love to inform you that your application to become a {{ application('name') }}({{ application('alias') }}) agent has been processed and approved.
You can now proceed to your dashboard to create your properties.
@endcomponent

@component('mail::button', ['url' => route('agent.index')])
    <i class="fa fa-eye" aria-hidden="true"></i> Dashboard
@endcomponent

Thanks,
{{ application('name') }}({{ application('alias') }}) Team
@endcomponent
