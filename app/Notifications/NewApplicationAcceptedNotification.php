<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Bus\Queueable;
use App\Mail\NewApplicationAcceptEmail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewApplicationAcceptedNotification extends Notification
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
        return (new NewApplicationAcceptEmail($this->agent))
            ->to($user->emailAddress(), $user->name());
    }
}
