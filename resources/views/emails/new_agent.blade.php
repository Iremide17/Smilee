@component('mail::message')
**Hello Administrator!

@component('mail::panel')
User: {{  $agent->user()->name() }},  has just submitted anh agent request application
**Please visit your dashboard to view the application and approve as desired after verification.
@endcomponent

@component('mail::button', ['url' => route('admin.agents.index' )])
    <i class="fa fa-eye" aria-hidden="true"></i> View Agents
@endcomponent

Thanks,
{{ application('name') }}
@endcomponent
