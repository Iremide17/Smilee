<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use App\Mail\NewBookingRejectedEmail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingRejectedNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewBookingRejectedEmail($this->booking))
            ->to($user->emailAddress(), $user->name());
    }
}
