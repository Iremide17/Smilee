<?php

namespace App\Listeners;

use App\Events\ApplicationWasRejected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewApplicationRejecttedNotification;

class SendAgentRejecttedNotification
{
    public function handle(ApplicationWasRejected $event)
    {
        $agent = $event->agent;

        $agent->user()->notify(new NewApplicationRejecttedNotification($event->agent));

    }
}
