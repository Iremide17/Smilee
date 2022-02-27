<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Agent;
use App\Mail\NewAgentEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAgentNotification extends Notification
{
    use Queueable;

    public $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewAgentEmail($this->agent))
            ->to($user->emailAddress(), $user->name());
    }
}
