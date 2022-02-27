<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Bus\Queueable;
use App\Mail\NewApplicationBannedEmail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewApplicationBannedNotification extends Notification
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
        return (new NewApplicationBannedEmail($this->agent))
            ->to($user->emailAddress(), $user->name());
    }
}
