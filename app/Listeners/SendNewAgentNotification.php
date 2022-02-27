<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\AgentWasCreated;
use App\Notifications\NewAgentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewAgentNotification implements ShouldQueue
{
    public function handle(AgentWasCreated $event)
    {
        $admins = User::where('type', User::ADMIN)->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewAgentNotification($event->agent));
        }
    }
}
