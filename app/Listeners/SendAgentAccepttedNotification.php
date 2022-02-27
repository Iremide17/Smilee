<?php

namespace App\Listeners;

use App\Events\ApplicationWasAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewApplicationAcceptedNotification;

class SendAgentAccepttedNotification
{
    public function handle(ApplicationWasAccepted $event)
    {
        $agent = $event->agent;

        $agent->user()->notify(new NewApplicationAcceptedNotification($event->agent));

    }
}
