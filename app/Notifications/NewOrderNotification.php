<?php

namespace App\Notifications;

use App\Models\User;
use App\Mail\NewOrderMail;
use App\Models\OrderDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $detail;

    public function __construct(OrderDetail $detail)
    {
        $this->detail = $detail;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewOrderMail($this->detail))
            ->to($user->emailAddress(), $user->name());
    }
}
