<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Gallery;
use App\Mail\NewGalleryEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewGalleryNotification extends Notification
{
    use Queueable;

    public $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail(User $user)
    {
        return (new NewGalleryEmail($this->Gallery))
            ->to($user->emailAddress(), $user->name());
    }
}
