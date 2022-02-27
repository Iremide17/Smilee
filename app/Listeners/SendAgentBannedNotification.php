<?php

namespace App\Listeners;

use App\Events\AgentBanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewApplicationBannedNotification;

class SendAgentBannedNotification
{
    public function handle(AgentBanned $event)
    {
        $agent = $event->agent;

        $agent->user()->notify(new NewApplicationBannedNotification($event->agent));

    }
}
