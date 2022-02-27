@component('mail::message')
**Hello User {{ $agent->user()->name() }}!

@component('mail::panel')
{{ application('name') }}({{ application('alias') }}) is sorry to inform you that your agent account has been suspended due to unusual activities in your account.
You can reach {{ application('name') }}({{ application('alias') }}) representatives on <a href="tel:+{{ application('line1') }}"></a> or Email:<a href="mailto:{{ application('email') }}"></a>
@endcomponent

Thanks,
{{ application('name') }}({{ application('alias') }}) Team
@endcomponent
