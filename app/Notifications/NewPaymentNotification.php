<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Payment;
use App\Mail\NewPaymentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPaymentNotification extends Notification
{
    use Queueable;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewPaymentMail($this->payment))
            ->to($user->emailAddress(), $user->name());
    }
}
