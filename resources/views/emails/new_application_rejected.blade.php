@component('mail::message')
**Hello User {{ $agent->user()->name() }}!

@component('mail::panel')
{{ application('name') }}({{ application('alias') }}) is sorry to inform you that your application to become a {{ application('name') }} agent has been rejectted being that you do no meet up with the requirements.
Pease try again! You can reach {{ application('name') }}({{ application('alias') }}) representatives on <a href="tel:+{{ application('line1') }}"></a> or Email:<a href="mailto:{{ application('email') }}"></a>
@endcomponent

Thanks,
{{ application('name') }}({{ application('alias') }}) Team
@endcomponent
